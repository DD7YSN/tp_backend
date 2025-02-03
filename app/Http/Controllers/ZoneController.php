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
        $id_user = 4;
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
        try{
            $request->validate([
                'nom_zone' => 'required|string|max:30',
            ]);
            Zone::create($request->all());
            return redirect()->route('zones.index');
        }catch(Exception $err){
            return response()->json([
            'error' => 'Failed to create Zone',
            'message' => $err->getMessage(),
            ], 500);
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
        $id_user = 4;
        $utilisateur = Utilisateur::find($id_user);
        $zone = Zone::find($id);
        return view('admins.zoneEdit', compact('zone','utilisateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $request->validate([
                'nom_zone' => 'required|string|max:30,nom_zone'.$id,
            ]);
            $zone = Zone::find($id);
            $zone->update($request->all());
            return redirect()->route('zones.index');
        }catch(Exception $err){
            return response()->json([
            'error' => 'Failed to create Zone',
            'message' => $err->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Zone::destroy($id);
        return redirect()->route('zones.index');
    }
}
