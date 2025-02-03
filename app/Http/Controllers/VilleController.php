<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use App\Models\Zone;
use App\Models\Ville;
use Exception;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = 4;
        $utilisateur = Utilisateur::find($id_user);
        $zones = Zone::all();
        $villes = Ville::with('zone')->orderBy('nom_ville')->paginate(2);
        return view('admins.ville', compact('villes','zones','utilisateur'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            
            $request->validate([
                'nom_ville' => 'required|string|max:30',
                'id_zone' => 'required|exists:zones,id',
                'ref' => 'required|string|max:10|unique:villes,ref',
                'frais_livraison' => 'required|numeric|min:0',
                'frais_retour' => 'required|numeric|min:0',
                'frais_refus' => 'required|numeric|min:0',
            ]);
            Ville::create($request->all());
            return redirect()->route('villes.index',['message' => 'Ville successfully created!'], 201);
        }catch(Exception $err){
            return response()->json([
            'error' => 'Failed to create Ville',
            'message' => $err->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $villes = Ville::where('id',$id)->orderBy('nom_ville')->get();
            return response()->json($villes);
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_user = 4;
        $utilisateur = Utilisateur::find($id_user);
        $zones = Zone::all();
        $ville = Ville::find($id);
        return view('admins.villeEdit', compact('ville','zones','utilisateur'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'nom_ville' => 'required|string|max:30|unique:villes,nom_ville,' . $id,
                'id_zone' => 'required|exists:zones,id',
                'ref' => 'required|string|max:10|unique:villes,ref,' . $id,
                'frais_livraison' => 'required|numeric|min:0',
                'frais_retour' => 'required|numeric|min:0',
                'frais_refus' => 'required|numeric|min:0',
            ]);
            $ville = Ville::find($id);
            $ville->update($request->all());
            return redirect()->route('villes.index');
        }catch(Exception $err){
            return response()->json([
            'error' => 'Failed to update Ville',
            'message' => $err->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ville::destroy($id);
        return redirect()->route('villes.index');
    }
}
