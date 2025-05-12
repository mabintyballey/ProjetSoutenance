<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
     public function showLoginForm()
    {   
        // dd('fonction admin est appeller');
        return view('auth.admin.loginAdmin'); // Vue personnalisée
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors(['email' => 'Vous n’êtes pas autorisé.']);
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     // On vérifie que l'utilisateur est bien un admin
    //     if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
    //         return redirect()->intended('/administration/pages/dashboard'); // ou la route que tu veux
    //     }

    //     return back()->withErrors([
    //         'email' => 'Identifiants invalides ou vous n\'êtes pas un administrateur.',
    //     ]);
    // }
        // public function login(Request $request)
        // {
        //     $credentials = $request->only('email', 'password');
        
        //     if (Auth::attempt($credentials)) {
        //         if (Auth::user()->role === 'admin') {
        //             return redirect()->route('dashboard');
        //         } else {
        //             Auth::logout();
        //             return redirect()->route('login.admin')->withErrors(['email' => 'Accès réservé aux administrateurs.']);
        //         }
        //     }
        
        //     return back()->withErrors(['email' => 'Email ou mot de passe incorrect.']);
        // }
}

