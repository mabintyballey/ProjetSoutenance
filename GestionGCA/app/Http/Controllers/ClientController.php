<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Affiche le tableau de bord du client avec ses dossiers.
     */
 public function dashboard()
{
    $user = auth()->user();

    // Récupérer le client lié à l'utilisateur connecté
    $client = $user->client;
    if (!$client) {
        abort(403, "Accès refusé - Vous n'êtes pas un client.");
    }

    // ✔️ 1. Nombre de dossiers par statut
    $activeCases = $client->dossiers()->where('statut', 'en_cours')->count();
    $closedCases = $client->dossiers()->where('statut', 'termine')->count();

    // ✔️ 2. Total de tous les dossiers
    $totalCases = $client->dossiers()->count();

    // ✔️ 3. Les 5 dossiers les plus récents
    $recentDossiers = $client->dossiers()
        ->orderBy('updated_at', 'desc')
        ->limit(5)
        ->get();

    // ✔️ 4. Les 5 rendez-vous à venir
    $upcomingRendezvous = $client->dossiers()
        ->with(['rendezvous' => function($query) {
            $query->where('date_heure', '>=', now())
                  ->orderBy('date_heure', 'asc');
        }])
        ->get()
        ->flatMap->rendezvous;

    $upcomingRendezvous = $upcomingRendezvous->take(5);

    // ✔️ 5. Retour vue avec toutes les données
    return view('client.pages.dashboard', compact(
        'activeCases',
        'closedCases',
        'totalCases',
        'recentDossiers',
        'upcomingRendezvous'
    ));
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
    public function suivi()
{
    $client = auth()->user()->client;

    $dossiers = Dossier::with(['domaine', 'avocat.user'])
                ->where('client_id', $client->id)
                ->latest()
                ->get();

    return view('client.dossiers.suivi', compact('dossiers'));
}
}
