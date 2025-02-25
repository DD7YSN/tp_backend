<?php

namespace App\Http\Controllers;

use App\Models\Bon_distribution;
use App\Models\Coli;
use App\Models\Zone;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\Ville;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BonDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $user = Auth::user();
        $id_ville = $user->local;
        $ville = Ville::where('id', $id_ville)->first();
        $zoneId = $ville->id_zone;
        $bonDistributions = Bon_distribution::whereHas('coli.ville.zone', function ($query) use ($zoneId) {
            $query->where('id', $zoneId);
        })
        ->with('coli.ville.zone')
        ->get();
        return view('moderateur.bonDistribution', compact('bonDistributions','zoneId1','id_ville'));
    }


    public function ajouterBonDistr(){
        $user = Auth::user();
        $id_ville = $user->local;
        $ville = Ville::where('id', $id_ville)->first();
        $zoneId = $ville->id_zone;
        $zone = Zone::where('id', $zoneId)->first();
        $colis = Coli::whereHas('ville.zone',function ($query) use ($zoneId) {
            $query->where('id', $zoneId);
        })->count();
       
        return view('moderateur.ajouteBonDistribution', compact('livreur', 'zone', 'colis'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = Auth::user();
        $id_ville = $user->local;
        $ville = Ville::where('id', $id_ville)->first();
        $zoneId = $ville->id_zone;
        $livreur = Utilisateur::whereHas('ville.zone', function ($query) use ($zoneId) {
            $query->where('id', $zoneId);
        })->get();
        $colis = Coli::whereHas('ville.zone', function ($query) use ($zoneId){
            $query->where('id', $zoneId);
        })
        ->whereNull('bon_distribution')
        ->whereHas('bon_ramassage.bon_envoi', function($query){
            $query->where('arrivee', 1);
        })
        ->with(['ville.zone', 'business', 'client', 'status'])
        ->get();
        return view('moderateur.creationBonDistribution', compact('livreur','colis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $bonDistributions = $request->input('bonDistributions');

    // Iterate over each bonDistribution in the request
    foreach ($bonDistributions as $bonDistribution) {
        // Create the BonDistribution with the livreur_id
        $bonDistr = Bon_distribution::create([
            'id_livreur' => $bonDistribution['livreur_id'],
            'status'=> 1
        ]);

        // Get the colis ids for the current bon distribution
        $colisIds = $bonDistribution['colis_ids'];

        // Update the corresponding Colis records with the bon_distribution_id and change status to 3
        Coli::whereIn('ref', $colisIds)->update([
            'bon_distribution' => $bonDistr->id,
            'id_status' => 3,
        ]);
    }

    // Return a success message or the created data
    return response()->json(['message' => 'Bon Distributions created successfully']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
