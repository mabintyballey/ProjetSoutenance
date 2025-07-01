<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvocatLoginController extends Controller
{
    public function showLoginForm()
    {   
        return view('auth.avocat.login');
    }

   public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    // Récupère l'utilisateur par email
    $user = User::where('email', $request->email)->first();

    // Vérifie si l'utilisateur existe
    if (!$user) {
        return back()->withErrors([
            'email' => 'Aucun compte trouvé avec cet email.',
        ]);
    }

    // Vérifie si c'est un avocat et s'il est actif
    if ($user->role === 'avocat' && (!$user->avocat || !$user->avocat->is_active)) {
        return back()->with('inactive_account', 'Votre compte est désactivé. Veuillez contacter l\'administrateur.');
    }

    // Authentification
    if (Auth::attempt($credentials) && Auth::user()->role === 'avocat') {
        return redirect()->intended('/avocat/dashboard');
    }

    return back()->withErrors([
        'email' => 'Identifiants invalides ou vous n\'êtes pas un avocat.',
    ]);
}

}

