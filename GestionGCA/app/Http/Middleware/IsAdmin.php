<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    // public function handle(Request $request, Closure $next)
    // {
    //     if (Auth::check() && Auth::user()->role === 'admin') {
    //         return $next($request);
    //     }

    //     Auth::logout();
    //     return redirect()->route('login.admin')->withErrors([
    //         'email' => 'Accès refusé. Réservé aux administrateurs.',
    //     ]);
    // }
    public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request);
    }

    abort(403);
}

}
