<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Produit;
use App\Models\Business;
use App\Models\Varainte;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $id_client = session('user')->id;
            
            $business = Business::where('id_utilisateur', $id_client)->get();

            $produits = Produit::with(['business', 'varainte' => function ($query) {
                $query->where('status', 1);
                $query->whereNotNull('id_responsable');
            }])
            ->where('id_client', $id_client)
            ->where('status', 1)
            ->whereNotNull('id_responsable')
            ->orderByDesc('id')
            ->paginate(25);

            return view('produits.index', compact('produits', 'business'));

        } catch (\Exception $e) {
            
            return redirect()->route('produits.index')->with('error', 'There was an error fetching the products. Please try again later.');
        }
    }


    public function produitsByBusiness(string $idBusiness)
    {
        try{

            $id_client = session('user')->id;
            
            
            $produits = Produit::where(['status' => 1, 'id_client' => $id_client, 'id_business' => $idBusiness])
            ->where(function($query) {
                $query->where('quantite', '>', 0)
                    ->orWhereNull('quantite');
            })
            ->whereNotNull('id_responsable')
            ->with(['varainte' => function($v) {
                $v->where('quantite', '>', 0);
            }])
            ->get();
            
            if ($produits->isEmpty()) {
                return response()->json(['message' => 'No produits'], 404);
            }
            
            return response()->json($produits);

        } catch (Exception $e) {

            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des produits'], 500);
        }

    }
    public function getProducts()
    {
        try{

            $id_client = session('user')->id;
            
            
            $produits = Produit::where(['status' => 1, 'id_client' => $id_client])
            ->where(function($query) {
                $query->where('quantite', '>', 0)
                    ->orWhereNull('quantite');
            })
            ->whereNotNull('id_responsable')
            ->with(['varainte' => function($v) {
                $v->where('quantite', '>', 0);
            }])
            ->get();
            
            if ($produits->isEmpty()) {
                return response()->json(['message' => 'No produits'], 404);
            }
            
            return response()->json($produits);

        } catch (Exception $e) {

            return response()->json(['error' => 'Une erreur est survenue lors de la récupération des produits'], 500);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_client = session('user')->id;
        $business = Business::where('id_utilisateur', $id_client)->get();
        return view('produits.create', compact('business'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_client = session('user')->id;
        try{

            $request->validate([
                'nom_produit' => 'required|string|max:30',
                'SKU' => 'required|string|max:255|unique:produits,SKU',
                'quantite' => 'required|integer|min:0',
                'note' => 'nullable|string|max:255',
                'id_business' => 'required|exists:businesses,id',
                'variants' => 'nullable|array',
                'variants.*.nom_varainte' => 'required|string|max:20',
                'variants.*.SKU' => 'required|string|max:255|unique:varaintes,SKU',
                'variants.*.quantite' => 'required|integer|min:0',
            ]);
            
            $data = [
                'nom_produit' => $request->nom_produit,
                'SKU' => $request->SKU,
                'quantite' => $request->quantite,
                'id_client' => $id_client,
                'note' => $request->note,
                'status' => 0,
                'id_business' => $request->id_business,
                'status' => 0,
                'id_responsable' => null,
            ];
            $produit = Produit::create($data);
            
            // Create variants ::::::::::::::::::::::
            if ($request->has('variants')) {
                foreach ($request->variants as $variant) {
                    Varainte::create([
                        'nom_varainte' => $variant['nom_varainte'],
                        'SKU' => $variant['SKU'],
                        'quantite' => $variant['quantite'],
                        'id_produit' => $produit->id,
                        'status' => 0,
                        'id_responsable' => null,
                    ]);
                }
            }
            return back()->with('success', 'Produit créé avec succès!');
        }catch (ValidationException $e) {

            return back()->with('error', 'Échec de la création du produit: ' . $e->errors());
            
        } catch (QueryException $e) {
            return back()->with('error', 'Erreur de base de données. Veuillez vérifier vos saisies.');
            
        } catch (Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer plus tard.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function inventory(string $id)
    {
        try {
            $id_client = session('user')->id;

            $business = Business::where('id_utilisateur', $id_client)->get();

            $produits = Produit::with('varainte', 'business')
                ->where('id_utilisateur', $id_client)
                ->orderByDesc('id')
                ->paginate(25);

            return view('produits.index', compact('produits', 'business'));

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la récupération de l\'inventaire: ' . $e->getMessage());
        }
}

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_client = session('user')->id;
        $produit = Produit::findOrFail($id);
        $business = Business::where('id_utilisateur', $id_client)->get();


        if ($produit->id_client != $id_client) {
            return redirect()->route('clients.produit.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
        }
        return view('produits.edit', compact('produit','business'));

    }


    /**
 * Update the specified resource in storage.
 */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try {
           
            $id_client = session('user')->id;

            $request->validate([
                'nom_produit' => 'required|string|max:30',
                'SKU' => 'required|string|max:255',
                'quantite' => 'required|integer|min:0',
                'note' => 'nullable|string|max:255',
                'id_business' => 'required|exists:businesses,id',
                'variants' => 'nullable|array',
                'variants.*.nom_varainte' => 'required|string|max:20',
                'variants.*.SKU' => 'required|string|max:255',
                'variants.*.quantite' => 'required|integer|min:0',
            ]);

           
            $produit = Produit::findOrFail($id);

           
            if ($produit->id_client != $id_client) {
                return redirect()->route('clients.produit.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce produit.');
            }

           
            $produit->update([
                'nom_produit' => $request->nom_produit,
                'SKU' => $request->SKU,
                'quantite' => $request->quantite,
                'note' => $request->note,
                'id_business' => $request->id_business,
                'status' => 0,
            ]);

           
            if ($request->has('variants')) {
                foreach ($request->variants as $v) {
                    if (isset($v['SKU'])) {
                     Varainte::where('SKU', $v['SKU'])
                        ->update([
                            'nom_varainte' => $v['nom_varainte'],
                            'SKU' => $v['SKU'],
                            'quantite' => $v['quantite'],
                            'status' => 0,
                            'id_responsable' => null,
                        ]);
                    }
                }
            }else{
                Varainte::where('id_produit', $produit->id)->delete();
            }

            return redirect()->route('clients.produit.index')->with('success', 'Produit mis à jour avec succès!');
        } catch (\Exception $e) {
           
            return redirect()->route('clients.produit.index')->with('error', 'Erreur lors de la mise à jour du produit: ' . $e->getMessage());
        }
    }



public function destroy(string $id)
{
    try {
        $id_client = session('user')->id;
        
        $produit = Produit::findOrFail($id);

        if ($produit->id_client != $id_client) {
            return redirect()->route('clients.produit.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce produit.');
        }
        
        Varainte::where('id_produit', $produit->id)->delete();
        $produit->delete();
        
        return redirect()->route('clients.produit.index')->with('success', 'Produit supprimé avec succès!');
    } catch (\Exception $e) {
        return redirect()->route('clients.produit.index')->with('error', 'Error deleting product: ' . $e->getMessage());
    }
}

}
