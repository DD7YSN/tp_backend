<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        try {
            $banques = Banque::paginate(15);
            return view('admins.banques.index', compact('banques'));
        } catch (\Exception $e) {
            return redirect()->route('banques.index')->with('error', 'Error loading banque data: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.banques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom_banque' => 'required|string|max:30',
            ]);

            $nom_banque = $request->input('nom_banque');
            $banque = Banque::create(['nom_banque' => $nom_banque]);

            return redirect()->route('banques.index')->with('success', "$banque->nom_banque banque created successfully.");
        } catch (\Exception $e) {
            return redirect()->route('banques.create')->with('error', 'Error creating banque: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $banque = Banque::findOrFail($id);
            return view('admins.banques.edit', compact('banque'));
        } catch (\Exception $e) {
            return redirect()->route('banques.index')->with('error', 'Banque not found: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nom_banque' => 'required|string|max:30',
            ]);

            $banque = Banque::findOrFail($id);
            $banque->nom_banque = $request->input('nom_banque');
            $banque->save();

            return redirect()->route('banques.index')->with('success', 'Banque updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('banques.edit', $id)->with('error', 'Error updating banque: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $banque = Banque::findOrFail($id);
            $banque->delete();

            return redirect()->route('banques.index')->with('success', 'Banque deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('banques.index')->with('error', 'Error deleting banque: ' . $e->getMessage());
        }
    }

}
