<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Role::where('nom_role','admin')->first();
        if (Auth::check() && Auth::user()->id_role === $role->id) {
                $request->session()->put('user',Auth::user());
                $request->session()->put('role','admin');
                return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}
