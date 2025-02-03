<?php

namespace App\Http\Controllers;

use App\Models\Bon_ramassage;
use App\Models\Coli;
use App\Models\Ville;
use Illuminate\Http\Request;

class Bon_ramassageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_client = session('user')->id;
        $noRamasse = Coli::where('id_client', $id_client)
            ->whereNull('bon_ramassage')->where('pret_preparation', 1)
            ->with('ville')->with('business')->get();
        $bonsRamassages = Bon_ramassage::with('ville')
            ->whereHas('coli', function ($query) use ($id_client) {
                $query->where('id_client', $id_client);
            })
            ->with([
                'coli' => function ($query) use ($id_client) {
                    $query->where('id_client', $id_client);
                }
            ])
            ->get();


        return view('bons.ramassage.index', compact('bonsRamassages', 'noRamasse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_client = session('user')->id;
        $villes = Ville::all();
        $noRamasse = Coli::where('id_client', $id_client)->whereNull('bon_ramassage')->where('pret_preparation', 1)->with('ville')->with('business')->get();
        return view('bons.ramassage.create', compact('noRamasse', 'villes'));
    }
    public function ColiAttendeBonRamassage()
    {
        $id_client = session('user')->id;
        $colis = Coli::where('id_client', $id_client)->whereNull('bon_ramassage')->where('pret_preparation', 1)->with('ville')->with('business')->get();
        return view('bons.ramassage.create', compact('colis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    private function refRamassage($idClient)
    {
        $currentTime = now()->format('dmyHis');
        $ref_amassage = "BL$currentTime$idClient";
        return $ref_amassage;
    }
    public function store(Request $request)
    {
        $id_client = session('user')->id;
        $colis = $request->input('colis');
        $villeRamassage = $request->input('villeRamassage');
        $ref_ramassage = $this->refRamassage($id_client);
        $bonRamassage = [
            'id_client' => $id_client,
            'ref_ramassage' => $ref_ramassage,
            'date' => '2025-01-23',
            'ville_ramassage' => $villeRamassage[0],
            'adresse_ramassage' => $villeRamassage[1],
        ];
        Bon_ramassage::create($bonRamassage);

        $bon = Bon_ramassage::where('ref_ramassage', $ref_ramassage)->first();

        foreach ($colis as $idColi) {
            $id = intval($idColi);
            $coli = Coli::find($id);

            if ($coli) {
                $coli->bon_ramassage = $bon->id;
                $coli->save();
            }
        }
        return response()->json([
            'message' => 'Data received successfully!',
            'colis' => $bonRamassage,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
