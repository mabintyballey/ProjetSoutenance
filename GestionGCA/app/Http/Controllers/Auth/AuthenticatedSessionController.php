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

        if ($user->role === 'client') {
            // Assurez-vous que la relation client existe
            if (!$user->client || $user->client->statut !== 'valide') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Votre compte client est en attente de validation par l\'administrateur.',
                ]);
            }

            return redirect()->route('client.dashboard');
        }

        // // Redirection selon les autres rôles
        // if ($user->role === 'avocat') {
        //     return redirect()->route('avocat.dashboard');
        // }

        // if ($user->role === 'admin') {
        //     return redirect()->route('admin.dashboard');
        // }

        // Rôle inconnu
        Auth::logout();
        return back()->withErrors([
            'email' => 'Rôle utilisateur non reconnu.',
        ]);
    }

    // Identifiants incorrects
    return back()->withErrors([
        'email' => 'Les identifiants fournis sont incorrects.',
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
