<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ClientValideMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminClientController extends Controller
{

public function index(Request $request)
{
    // Requête initiale : utilisateurs avec rôle 'client' + relation 'client'
    $query = User::with('client')->where('role', 'client');

    // Recherche sur prénom ou nom
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('prenom', 'like', "%{$search}%")
              ->orWhere('nom', 'like', "%{$search}%");
        });
    }

    // Filtrage sur le statut dans la table liée 'clients'
    if ($request->filled('statut')) {
        $statut = $request->statut;
        $query->whereHas('client', function ($q) use ($statut) {
            $q->where('statut', $statut);
        });
    }

    // Tri sécurisé : on autorise uniquement certains champs
    $allowedSorts = ['prenom', 'nom', 'email', 'created_at'];
    if ($request->filled('sort_by') && in_array($request->sort_by, $allowedSorts)) {
        $sortDirection = $request->input('sort_direction', 'asc') === 'desc' ? 'desc' : 'asc';
        $query->orderBy($request->sort_by, $sortDirection);
    } else {
        // Tri par défaut
        $query->orderBy('created_at', 'desc');
    }

    // Pagination (3 clients par page par défaut)
    $clients = $query->paginate(3)->withQueryString();

    // Renvoi vers la vue avec les données et paramètres pour conserver l'état
    return view('administration.clients.index', [
        'clients' => $clients,
        'search' => $request->search,
        'statut' => $request->statut,
        'sort_by' => $request->sort_by,
        'sort_direction' => $request->input('sort_direction', 'asc'),
    ]);
}


public function destroy($id)
{
    $client = User::with('client.dossiers')->findOrFail($id);

    // Vérifier si des dossiers ne sont pas 'en_attente' ou 'terminé'
    $hasDossiersInvalides = $client->client && $client->client->dossiers->contains(function ($dossier) {
        return !in_array($dossier->statut, ['en_attente', 'termine']);
    });

    if ($hasDossiersInvalides) {
        return back()->with('error', 'client_dossiers_invalides');
    }

    $client->delete();
    return back()->with('success', 'Client supprimé avec succès.');
}

public function voirDossiers($id)
{
    $user = User::findOrFail($id);

    if (!$user->client) {
        abort(404, 'Ce client n’existe pas ou n’est pas validé.');
    }

    $client = $user->client;

    // 🔁 Pagination des dossiers du client avec relation domaine & avocat
    $dossiers = $client->dossiers()->with('domaine', 'avocat.user')->paginate(4); 

    return view('administration.clients.dossiers', compact('client', 'user', 'dossiers'));
}



public function attente()
{
    // On récupère les clients en attente avec leurs utilisateurs
    $clients = Client::with('user')->where('statut', 'en_attente')->paginate(6);
    return view('administration.clients.clients', compact('clients'));
}

public function valider($id)
{
    $client = Client::with('user', 'requetes')->findOrFail($id);

    $client->statut = 'valide';
    $client->save();

    if ($client->requetes()->exists()) {
        $requete = $client->requetes()->latest()->first();
        $requete->statut = 'acceptee';
        $requete->date_statut = now();
        $requete->save();
    }

    if ($client->user) {
        Mail::to($client->user->email)->send(new ClientValideMail($client));
    }

    return back()->with('success', 'Client validé avec succès.');
}

public function rejeter($id)
{
    $client = Client::findOrFail($id);
    $client->statut = 'rejete';
    $client->save();

    return back()->with('success', 'Client rejeté et archivé.');
}



public function exporterDossiersPDF(Request $request, $id)
{
    $client = User::findOrFail($id);

    $query = $client->dossiersSoumis();

    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('titre', 'like', "%$keyword%")
              ->orWhere('probleme', 'like', "%$keyword%")
              ->orWhere('adversaire', 'like', "%$keyword%");
        });
    }

    if ($request->filled('domaine')) {
        $query->where('domaine', $request->domaine);
    }

    $dossiers = $query->get();

    $pdf = Pdf::loadView('administration.clients.pdf_dossiers', [
        'client' => $client,
        'dossiers' => $dossiers
    ]);

    return $pdf->download("dossiers_{$client->name}_{$client->prenom}.pdf");
}

}
