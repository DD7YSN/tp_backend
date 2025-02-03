<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use App\Models\Role;
use App\Models\Ville;
use App\Models\Utilisateur;
use Exception;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = session('user')->id;
        $utilisateurs = Utilisateur::with('ville', 'role')
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->whereNotNull('local')
            ->whereNotNull('id_banque')
            ->orderByDesc('id')
            ->paginate(5);
        return view('admins.utilisateur.index', compact('utilisateurs'));
    }
    public function attendeActivation()
    {
        $id = session('user')->id;
        $utilisateurs = Utilisateur::with('ville', 'role')
            ->where('id', '!=', $id)
            ->where('status', 0)
            ->whereNotNull('local')
            ->whereNotNull('id_banque')
            ->orderByDesc('id')
            ->paginate(5);
        return view('admins.utilisateur.attendeActivation', compact('utilisateurs'));
    }
    public function role($nom_role)
    {
        $id = session('user')->id;
        $utilisateurs = Utilisateur::with('ville', 'role')
            ->where('id', '!=', $id)
            ->where('status', 1)
            ->where('active', 1)
            ->whereHas('role', function ($query) use ($nom_role) {
                $query->where('nom_role', $nom_role);
            })->orderByDesc('id')->paginate(2);
        return view('admins.utilisateur.index', compact('utilisateurs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $banques = Banque::all();
        $villes = Ville::all();
        return view('admins.utilisateur.create', compact('roles', 'banques', 'villes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:30',
                'cin' => 'required|string|max:15',
                'telephone' => ['required', 'string', 'regex:/^(\+212)?\d{10}$/'],
                'email' => 'required|email|max:50|unique:utilisateurs,email',
                'password' => 'required|string|min:8',
                'local' => 'required|integer|exists:villes,id',
                'adresse' => 'required|string|max:255',
                'id_banque' => 'required|integer|exists:banques,id',
                'numero_compte' => 'required|string|max:255',
                'id_role' => 'required|integer|exists:roles,id',
            ]);
            Utilisateur::create($request->all());
            return redirect()->route('utilisateur.index', ['message' => 'create successfully created!'], 201);
        } catch (Exception $err) {
            return response()->json([
                'error' => 'Failed to create utilisateur',
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    public function deactivateAccount(Request $request, $id)
    {
        $user = Utilisateur::find($id);
        $user->active = 0;
        $user->save();
    }
    public function activeAccount(Request $request, $id)
    {
        $user = Utilisateur::find($id);
        $user->active = 1;
        $user->save();
    }
    public function accepteAccount(Request $request, $id)
    {
        $user = Utilisateur::find($id);
        $user->status = 1;
        $user->active = 1;
        $user->save();
    }
    public function refuseAccount(Request $request, $id)
    {
        $user = Utilisateur::find($id);
        $user->status = 0;
        $user->active = 0;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
