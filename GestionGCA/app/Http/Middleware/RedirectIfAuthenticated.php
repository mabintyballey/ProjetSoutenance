<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($user->role === 'avocat') {
                    return redirect()->route('avocat.dashboard');
                } elseif ($user->role === 'client') {
                    if ($user->statut_validation === 'valide') {
                        return redirect()->route('client.dashboard');
                    } else {
                        return redirect()->route('client.attente');
                    }
                }

                return redirect('/'); 
            }
        }

        return $next($request);
    }

    public function redirectTo()
    {
        $user = auth()->user();
    
        if ($user->role === 'client') {
            if ($user->statut_validation === 'valide') {
                return '/client/dashboard';
            } else {
                return '/client/attente-validation';
            }
        }
    }

}
