<?php

namespace App\Http\Controllers;

use App\Models\Requete;
use App\Models\Avocat;
use App\Models\Dossier;
use Illuminate\Http\Request;
use App\Notifications\AvocatAssigne;
use App\Notifications\RequeteAcceptee;

class AdminRequeteController extends Controller
{
    public function index()
    {
        $requetes = Requete::where('statut', 'en_attente')->with('client', 'domaine')->latest()->get();
        return view('administration.requetes.index', compact('requetes'));
    }

    public function show($id)
    {
        $requete = Requete::with('client.user', 'domaine', 'documents')->findOrFail($id);
        $avocats = Avocat::where('domaine_id', $requete->domaine_id)->get();
        return view('admin.requetes.show', compact('requete', 'avocats'));
    }

    // public function assignerAvocat(Request $request, $id)
    // {
    //     $request->validate([
    //         'avocat_id' => 'required|exists:avocats,id',
    //     ]);

    //     $requete = Requete::findOrFail($id);
    //     $requete->avocat_id = $request->avocat_id;
    //     $requete->statut = 'acceptee';
    //     $requete->date_statut = now();
    //     $requete->save();

    // $requete->avocat_id = $request->avocat_id;
    // $requete->statut = 'acceptee';
    // $requete->date_statut = now();
    // $requete->save();
    
    // // Notifier le client
    // $client = $requete->client->user;
    // $client->notify(new RequeteAcceptee($requete));

    //     return redirect()->route('admin.requetes.index')->with('success', 'Avocat assigné avec succès.');
    // }
    public function assignerAvocat(Request $request, $id)
{
    $request->validate([
        'avocat_id' => 'required|exists:avocats,id',
    ]);

    $dossier = Dossier::findOrFail($id);
    $dossier->avocat_id = $request->avocat_id;
    $dossier->statut = 'en_cours';
    $dossier->save();

    // Optionnel : notifier avocat ou client
    // Notifier l'avocat assigné
      $avocat = $dossier->avocat; // relation "avocat" définie dans ton modèle Dossier
      if ($avocat && $avocat->user) {
          $avocat->user->notify(new AvocatAssigne($dossier));
      }

    return back()->with('success', 'Avocat assigné ou mis à jour avec succès.');
}

}

