<?php

namespace App\Http\Controllers;

use App\Models\Monnie;
use Illuminate\Http\Request;

class MonnieConteroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $monnies = Monnie::paginate(15);
            return view('admins.monnies.index', compact('monnies'));
        } catch (\Exception $e) {
            return redirect()->route('monnies.index')->with('error', 'Error loading monnie data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.monnies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_monnie' => 'required|string|max:20',
        ]);

        try {
            $monnie = Monnie::create(['nom_monnie' => $request->input('nom_monnie')]);
            return redirect()->route('monnies.index')->with('success', "$monnie->nom_monnie monnie created successfully.");
        } catch (\Exception $e) {
            return redirect()->route('monnies.index')->with('error', 'Error creating monnie: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $monnie = Monnie::findOrFail($id);
            return view('admins.monnies.edit', compact('monnie'));
        } catch (\Exception $e) {
            return redirect()->route('monnies.index')->with('error', 'Error finding monnie for editing: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom_monnie' => 'required|string|max:20',
        ]);

        try {
            $monnie = Monnie::findOrFail($id);
            
            $monnie->nom_monnie = $request->input('nom_monnie');
            $monnie->save();

            return redirect()->route('monnies.index')->with('success', 'Monnie updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('monnies.index')->with('error', 'Error updating monnie: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $monnie = Monnie::findOrFail($id);

            $monnie->delete();

            return redirect()->route('monnies.index')->with('success', "$monnie->nom_monnie Monnie deleted successfully.");
        } catch (\Exception $e) {
            return redirect()->route('monnies.index')->with('error', 'Error deleting monnie: ' . $e->getMessage());
        }
    }
}
