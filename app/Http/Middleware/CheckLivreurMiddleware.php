<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLivreurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::where('nom_role', 'livreur')->first();
        if (Auth::check() && Auth::user()->id_role === $role->id) {
            $request->session()->put('user', Auth::user());
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}
