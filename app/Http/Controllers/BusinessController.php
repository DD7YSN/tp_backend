<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function indexByClient()
    {
        $id_client = session('user')->id;
        $business = Business::where('id_utilisateur', $id_client)
            ->with('coli', function ($query) {
                $query->whereNotNull('bon_ramassage');
            })
            ->with('produit')->get();
        return view('businesses.indexByClient', compact('business'));
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
        $request->validate([
            'ref' => 'required|string|max:5',
            'nom_business' => 'required|string|max:255',
            'telephone' => 'required|regex:/^\+212\d{9}$/',
        ]);

        Business::create([
            'ref' => $request->ref,
            'nom_business' => $request->nom_business,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('business.index')->with('success', 'Business added successfully');
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
