<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Vérification de l'accès selon le rôle
        // if ($user->role === 'admin') {
        //     return redirect()->route('admin.dashboard');
        // }

        // if ($user->role === 'avocat') {
        //     if (!$user->is_active) {
        //         Auth::logout();
        //         return back()->withErrors([
        //             'email' => 'Votre compte avocat n\'est pas encore activé.',
        //         ]);
        //     }
        //     return redirect()->route('avocat.dashboard');
        // }

        if ($user->role === 'client') {
            if ($user->statut_validation !== 'valide') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Votre compte client est en attente de validation par l\'administrateur.',
                ]);
            }
            return redirect()->route('client.dashboard');
        }

        // Si rôle inconnu
        Auth::logout();
        return back()->withErrors([
            'email' => 'Rôle utilisateur non reconnu.',
        ]);
    }

    return back()->withErrors([
        'email' => 'Les identifiants sont incorrects.',
    ]);
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
