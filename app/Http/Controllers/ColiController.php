<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coli;
use App\Models\Zone;
use App\Models\Ville;
use App\Models\Status;
use App\Models\General;
use App\Models\Produit;
use App\Models\Business;
use App\Models\Varainte;
use App\Models\Coli_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ColiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colis = [];
        return view('colis.index', compact('colis'));
    }
    public function listeColis()
    {
        $id_client = session('user')->id;
        $colis = Coli::with('business','status')->where('id_client', $id_client)->whereNotNull('bon_ramassage')->with('ville')->with('business')->orderByDesc('id')->get();
        $status = Status::all();
        $business = Business::where('id_utilisateur', $id_client)->get();
        $villes = Ville::all();
        return view('colis.index', compact('colis', 'status','business', 'villes'));
    }
    public function colisAttenderRamassage()
    {
        $id_client = session('user')->id;
        $colis = Coli::where('id_client', $id_client)->whereNotNull('bon_ramassage')->with('ville')->with('business')->orderByDesc('id')->get();
        return view('colis.colisAttenderRamassage', compact('colis'));
    }
    public function colisNonExpedies()
    {
        $id_client = session('user')->id;
        $colis = Coli::where('id_client', $id_client)->whereNotNull('bon_ramassage')->with('ville')->with('business')->orderByDesc('id')->get();
        return view('colis.colisNonExpedies', compact('colis'));
    }

    public function ticketColi($id)
    {
        $id_client = session('user')->id;
        $coli = Coli::with(['bon_ramassage.ville:id,nom_ville', 'business', 'ville.zone:id,nom_zone'])
            ->where('id', $id)
            ->where('id_client', $id_client)
            ->first();

        $general = General::first();

        return view('colis.ticketColi', compact('coli', 'general'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_client = session('user')->id;
        $villes = Ville::all();
        $business = Business::where('id_utilisateur', $id_client)->get();
        return view('colis.create', compact('villes', 'business'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function trackNumber($idColi, $fromCity, $toCity)
    {
        $currentTime = now()->format('dmyHis');
        $track_number = "$fromCity$toCity$currentTime$idColi";
        return $track_number;
    }

    public function store(Request $request)
    {
        $id_client = session('user')->id;
    
        try{
            $request->validate([
                'destinataire' => 'required|string|max:255',
                'telephone' => 'required|string|max:20',
                'id_ville' => 'required|integer',
                'id_business' => 'required|exists:businesses,id',
                'adresse' => 'required|string|max:255',
                'marchandise' => 'required|string|max:255',
                'prix' => 'required|numeric',
                'commentaire' => 'nullable|string',
                'ouvrir' => 'nullable|boolean',
                'variant' => 'nullable|array',
                'variant.*.SKU' => 'nullable|string',
                'variant.*.quantity' => 'nullable|integer|min:1',
            ]);

            $dataColi = $request->only([
                    'destinataire', 'telephone', 'id_ville', 'id_business', 'adresse', 'marchandise', 'prix', 'commentaire'
                ]);

            $fromCity = Ville::find($dataColi['id_ville'])->nom_ville[0] ?? 'X';
            $toCity = Ville::find($dataColi['id_ville'])->nom_ville[0] ?? 'X';
            $track_number = $this->trackNumber($id_client, $fromCity, $toCity);

            $attRama = Status::where('nom_status', 'attender ramassage')->firstOrFail();

            $request->has('ouvrir') ? $dataColi['ouvrir'] = 1 : $dataColi['ouvrir'] = 0;
            $dataColi['track_number'] = $track_number;
            $dataColi['date_creation'] = now()->toDateString();
            $dataColi['id_client'] = $id_client;
            $dataColi['id_status'] = $attRama->id;
            $dataColi['bon_ramassage'] = null;
            
            $coli = Coli::create($dataColi);
            if ($request->has('produit') && !empty($request->produit) && $request->produit != null) {
                $produit = $request->input('produit');
                $totalQteP = 0;
                
                foreach ($produit as $key => $quantite) {
                    if (isset($key) && isset($quantite)) {
                        $pro = Produit::where('SKU', $key)->first();
                        if ($pro) {
                            Coli_stock::create([
                                'id_coli' => $coli->id,
                                'SKU' => $key,
                                'quantite' => (int) $quantite <= $pro->quantite ? (int)$quantite : $pro->quantite,
                            ]);
                            $totalQteP += (int) $quantite <= $pro->quantite ? (int)$quantite : $pro->quantite;                           
                            if ((int)$quantite <= $pro->quantite) {
                                $pro->quantite -= (int) $quantite;
                            }else{
                                $pro->quantite = 0;
                            }
                            $pro->save();
                        }
                    }
                }
                $coli->coli_type = "stock";
                $coli->save();
            }
            if ($request->has('variant') && !empty($request->variant) && $request->variant != null) {
                $variant = $request->input('variant');
                $totalQteV = 0;
                foreach ($variant as $key => $quantite) {
                    if (isset($key) && isset($quantite)) {
                        $var = Varainte::where('SKU', $key)->first();
                        if ($var) {
                            Coli_stock::create([
                                'id_coli' => $coli->id,
                                'SKU' => $key,
                                'quantite' => (int) $quantite <= $var->quantite ? (int)$quantite : $var->quantite,
                            ]);
                            $totalQteV += (int) $quantite <= $var->quantite ? (int)$quantite : $var->quantite;                           
                            if ((int)$quantite <= $var->quantite) {
                                $var->quantite -= (int) $quantite ;
                            }else{
                                $var->quantite = 0;
                            }
                            $var->save();
                        }
                    }
                }
                $coli->coli_type = "stock";
                $coli->save();
            }
            return redirect()->route('colis.create');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function show(string $id)
    {
        $id_client = session('user')->id;
        $coli = Coli::where('id', $id)
            ->where('id_client', $id_client)
            ->with(['ville', 'business'])
            ->firstOrFail();

        return view('colis.show', compact('coli'));
    }



    public function edit(string $id)
    {
        $id_client = session('user')->id;
        $coli = Coli::with('ville')->where('id', $id)
            ->where('id_client', $id_client)
            ->firstOrFail();

        $villes = Ville::all();
        $business = Business::where('id_utilisateur', $id_client)->get();

        return view('colis.edit', compact('coli', 'villes', 'business'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'destinataire' => 'required|string',
            'telephone' => 'required|string|min:10|max:15',
            'id_ville' => 'required|exists:villes,id',
            'id_business' => 'required|exists:businesses,id',
            'adresse' => 'required|string',
            'marchandise' => 'required|string',
            'prix' => 'required|numeric',
            'commentaire' => 'nullable|string',
        ]);
        if ($request->filled('ouvrir')) {
            $request['ouvrir'] = 1;
        } else {
            $request['ouvrir'] = 0;
        }
        $coli = Coli::findOrFail($id);

        $fromCity = Ville::find($request->id_ville)->nom_ville[0] ?? 'X';
        $toCity = Ville::find($request->id_ville)->nom_ville[0] ?? 'X';

        $track_number = $this->trackNumber($coli->id_client, $fromCity, $toCity);

        $coli->update([
            'destinataire' => $request->destinataire,
            'telephone' => $request->telephone,
            'id_ville' => $request->id_ville,
            'adresse' => $request->adresse,
            'prix' => $request->prix,
            'commentaire' => $request->commentaire,
            'ouvrir' => $request->ouvrir,
            'marchandise' => $request->marchandise,
            'id_business' => $request->id_business,
            'track_number' => $track_number,
        ]);
        return redirect()->route('colis.listeColis')->with('success', 'Coli updated successfully.');
    }


    public function destroy(string $id)
    {
        $id_client = session('user')->id;
        $coli = Coli::where('id', $id)
            ->where('id_client', $id_client)
            ->firstOrFail();
        
        $coli->delete();
        return response()->json(['message' => 'Colis deleted successfully'], 200);
    }

    public function colisByFilter(Request $request)
    {
        $id_client = session('user')->id;
        $search = $request->input('track_number');
        $etat = $request->input('etat');
        $status = $request->input('id_status');
        $ville = $request->input('id_ville');
        $business = $request->input('id_business');
        $date = $request->input('date');

        $query = Coli::query();

        if ($search && !empty($search) && $search != '-1') {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->where('track_number', 'LIKE', "%$search%");
        }

        if ($etat && !empty($etat) && $etat != '-1') {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->where('etat', $etat);
        }

        if ($status && !empty($status) && $status != '-1') {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->where('id_status', $status);
        }

        if ($ville && !empty($ville) && $ville != '-1') {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->where('id_ville', $ville);
        }

        if ($business && !empty($business) && $business != '-1') {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->where('id_business', $business);
        }

        if ($date && !empty($date)) {
            $query->whereNotNull('bon_ramassage')->where('id_client',$id_client)->whereDate('date_creation', $date);
        }
        $colis = $query->with(['business', 'ville','status'])->whereNotNull('bon_ramassage')->where('id_client',$id_client)->orderByDesc('id')->get();
        return response()->json(['colis' => $colis]);
    }

    public function colisZone()
    {
        $ville = Auth::user()->local;
        $zoneId = Ville::find($ville)->id_zone;
        $colis = Coli::whereHas('ville.zone', function ($query) use($zoneId){
            $query->where('id', $zoneId);
        })
        ->whereHas('bon_ramassage.bon_envoi', function($query){
            $query->where('arrivee', 1);
        })
        ->whereNotIn('id_status', [5, 6])
        ->with(['ville.zone', 'business', 'client', 'status'])
        ->get();
        return view('moderateur.colis', compact('colis'));
    }
    
    public function colisByLivreur(){
        $userId = Auth::user()->id;
        $colis = Coli::wherehas('bon_distribution', function($query) use($userId){
            $query->where('id_livreur', $userId);
        })->with(['ville', 'business', 'status'])->get();
        $statuses = Status::all();
        return view('livreur.index', compact('colis', 'statuses'));
    }

    public function changerStatusByLivreur(Request $request){
        $status = $request->input('status');
        $commentaire = $request->input('commentaire');
        $coliSelected = $request->input('idColi');
        $coli = Coli::where('track_number', $coliSelected)->first();
        $coli->id_status = $status;
        $coli->save();
    }
}
