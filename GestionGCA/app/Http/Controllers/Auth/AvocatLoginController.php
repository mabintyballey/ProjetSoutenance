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
        // Vérifie si l'utilisateur existe
         $user = User::where('email', $request->email)->first();

         if (!$user->is_active) {
            return back()->with('inactive_account', 'Votre compte est désactivé. Veuillez contacter l\'administrateur.');
        }
        if (Auth::attempt($credentials) && Auth::user()->role === 'avocat') {
            return redirect()->intended('/avocat/dashboard');
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides ou vous n\'êtes pas un avocat.',
        ]);
    }
}

