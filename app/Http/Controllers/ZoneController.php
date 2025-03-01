<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Zone;
use App\Models\Ville;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = session('user')->id;
        $utilisateur = Utilisateur::find($id_user);
        $zoneWithVille = Zone::with('ville')->orderBy('nom_zone')->paginate(5);
        return view('admins.zone', compact('zoneWithVille','utilisateur'));
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
        try {
            $request->validate([
                'nom_zone' => 'required|string|max:30|unique:zones,nom_zone',
            ]);

            Zone::create($request->all());
            
            return redirect()->route('zones.index')->with('success', 'Zone créée avec succès.');
        } catch (Exception $err) {
            return redirect()->route('zones.index')->with('error', 'Échec de la création de la zone: ' . $err->getMessage());
        }
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id_user = session('user')->id;
        $utilisateur = Utilisateur::find($id_user);
        $zone = Zone::find($id);
        return view('admins.zoneEdit', compact('zone','utilisateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nom_zone' => 'required|string|max:30|unique:zones,nom_zone,' . $id,
            ]);

            $zone = Zone::findOrFail($id);

            $zone->update($request->all());

            return redirect()->route('zones.index')->with('success', 'Zone mise à jour avec succès.');
        } catch (Exception $err) {
            return redirect()->route('zones.index')->with('error', 'Échec de la mise à jour de la zone: ' . $err->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Zone::destroy($id);
            return redirect()->route('zones.index')->with('success', 'Zone supprimée avec succès.');
        } catch (Exception $err) {
            return redirect()->route('zones.index')->with('error', 'Échec de la suppression de la zone: ' . $err->getMessage());
        }
    }
}
