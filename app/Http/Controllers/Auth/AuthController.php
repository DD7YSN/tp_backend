<?php

namespace App\Http\Controllers\Auth;

use Log;
use session;
use Exception;
use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.registerSide');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:30',
                'email' => 'required|string|email|max:50|unique:utilisateurs',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user = $request->all();
            $role = Role::where('nom_role', 'client')->first();
            $user['id_role'] = $role->id;
            $user['password'] = Hash::make($request->password);

            Utilisateur::create($user);
            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        } catch (Exception $err) {
            return response()->json([
                'error' => 'Failed to create utilisateur',
                'message' => $err->getMessage(),
            ], 500);
        }
    }

    public function showLoginForm()
    {
        return view('auth.loginSide');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $id = $user->id_role;
            $role = Role::find($id);
            if ($role->nom_role === 'admin') {
                return redirect()->intended('admin/');
            }
            if ($role->nom_role === 'client') {
                return redirect()->intended("client/$user->id");
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        Auth::logout();
        return redirect()->route('login');
    }
}
