<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Banque;
use App\Models\Monnie;
use App\Models\Ville;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = session('user')->id;
        $utilisateur = Utilisateur::with(['client.type','client.rank'])->find($id_user);
        $utilisateur->makeHidden(['password']);
        $banques = Banque::all();
        $villes = Ville::all();
        $monnies = Monnie::all();
        return view('profile.index', compact('utilisateur', 'monnies', 'banques', 'villes'));
        // return response()->json($utilisateur);

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
        //
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
