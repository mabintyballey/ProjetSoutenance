<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Affiche le tableau de bord du client avec ses dossiers.
     */
    public function dashboard()
    {
        $dossiers = Dossier::where('client_id', Auth::id())->latest()->get();
        return view('client.dashboard', compact('dossiers'));
    }

    /**
     * Affiche le formulaire de complétion de profil.
     */
    public function editProfile()
    {
        $client = Auth::user();
        return view('client.pages.profile', compact('client'));
    }

    /**
     * Met à jour le profil du client.
     */
    // public function updateProfile(Request $request)
    // {
    //     $request->validate([
    //         'prenom' => 'required|string|max:255',
    //         'telephone' => 'required|string|max:20',
    //         'adresse' => 'required|string|max:255',
    //     ]);

    //     $user = Auth::guard('client')->user();

    //     // Mise à jour manuelle
    //     $user->prenom = $request->prenom;
    //     $user->telephone = $request->telephone;
    //     $user->adresse = $request->adresse;
    //     $user->save();

    //     return redirect()->route('client.attente')->with('success', 'Profil soumis pour validation.');
    // }

    /**
     * Page affichée après soumission du profil, en attente de validation.
     */
    public function attenteValidation()
    {
        return view('client.attente');
    }
}
