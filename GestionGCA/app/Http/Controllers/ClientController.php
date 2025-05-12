<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Dashboard client
     */
//     public function updateProfile(Request $request)
//    {
//     $user = auth()->user();
//     $user->update($request->only(['prenom', 'telephone', 'adresse']));
//     $user->statut_validation = 'en_attente';
//     $user->save();

//     return redirect()->route('client.dashboard')->with('message', 'Profil mis à jour. En attente de validation.');
//   }

    public function dashboard()
    {
        // Vérifie si le client est validé ou non
        $user = auth()->user();
        if ($user->statut_validation === 'en_attente') {
            return redirect()->route('client.editProfile')->with('message', 'Complétez votre profil pour continuer.');
        }

        return view('client.dashboard');
    }
    
    /**
     * Formulaire de complétion du profil
     */
    public function editProfile()
    {
        return view('client.complete-profile');
    }

    /**
     * Mise à jour du profil client après la première connexion
     */
    // public function updateProfile(Request $request)
    // {
    //     $request->validate([
    //         'domaine_juridique' => 'required|string',
    //         'probleme' => 'required|string',
    //         'fichier' => 'required|file|mimes:pdf,png|max:2048',
    //         'information_adverse' => 'required|string',
    //     ]);

    //     $user = auth()->user();

    //     // Stocker le fichier
    //     $path = $request->file('fichier')->store('dossiers', 'public');

    //     // Mise à jour de l'utilisateur
    //     $user->update([
    //         'domaine_juridique' => $request->domaine_juridique,
    //         'probleme' => $request->probleme,
    //         'fichier' => $path,
    //         'information_adverse' => $request->information_adverse,
    //         'statut_validation' => 'en_attente', // Statut à valider par l'admin
    //     ]);

    //     // Notifier l'admin (optionnel)
    //     // Notification::route('mail', 'admin@example.com')->notify(new ClientProfileSubmitted($user));

    //     return redirect()->route('dashboard')->with('message', 'Votre profil a été soumis pour validation.');
    // }
}
