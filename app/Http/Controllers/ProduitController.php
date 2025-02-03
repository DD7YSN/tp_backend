<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Produit;
use App\Models\Varainte;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_client = session('user')->id;
        $business = Business::where('id_utilisateur', $id_client)->get();
        $produits = Produit::with('business')->with([
            'varainte' => function ($query) {
                $query->where('status', 1);
                $query->whereNotNull('id_responsable');
            }
        ])->where('id_utilisateur', $id_client)->whereHas('varainte', function ($query) {
            $query->where('status', 1);
            $query->whereNotNull('id_responsable');
        })->orderByDesc('id')->paginate(5);
        return view('produits.index', compact('produits', 'business'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function inventory(string $id)
    {
        $id_client = session('user')->id;
        $business = Business::where('id_utilisateur', $id_client);
        $produits = Produit::with('varainte')->with('business')->where('id_utilisateur', $id_client)->orderByDesc('id')->paginate(5);
        return view('produits.index', compact('produits', 'business'));
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
