<?php

namespace App\Http\Controllers;
use App\Models\Dossier;
use App\Models\Document;
use App\Models\avocat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AvocatAssigne;
use App\Models\Requete;
use App\Notifications\RequeteAcceptee;

class DossierController extends Controller
{
public function index(Request $request)
{
    $query = Dossier::with(['client.user', 'avocat']);

    // Filtres
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    if ($request->filled('description')) {
        $query->where('description', 'like', '%' . $request->description . '%');
    }

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->whereHas('client.user', function ($q2) use ($request) {
                $q2->where('prenom', 'like', '%' . $request->search . '%')
                   ->orWhere('nom', 'like', '%' . $request->search . '%');
            })->orWhereHas('avocat.user', function ($q2) use ($request) {
                $q2->where('prenom', 'like', '%' . $request->search . '%')
                   ->orWhere('nom', 'like', '%' . $request->search . '%');
            });
        });
    }

    $dossiers = $query->latest()->paginate(6);

    // Statistiques
    $stats = [
        'total' => Dossier::count(),
        'termine' => Dossier::where('statut', 'termine')->count(),
        'en_attente' => Dossier::where('statut', 'en_attente')->count(),
        'en_cours' => Dossier::where('statut', 'en_cours')->count(),
    ];

    // Récupération des avocats filtrés par spécialité si un dossier est présent
    $avocats = collect();
    if ($dossiers->count() > 0) {
        $firstDossier = $dossiers->first();
        $avocats = Avocat::where('specialite_id', $firstDossier->domaine_id)->get();
    }

    return view('administration.dossiers.index', compact('dossiers', 'stats', 'avocats'));
}

    public function create()
    {
        return view('client.dossiers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_affaire' => 'required',
            'description' => 'required',
            'information_adverse' => 'required',
        ]);

        Dossier::create([
            'client_id' => auth()->id(),
            'type_affaire' => $request->type_affaire,
            'description' => $request->description,
            'information_adverse' => $request->information_adverse,
        ]);

        return redirect()->route('client.dashboard')->with('success', 'Requête envoyée avec succès.');
    }


public function show($id)
{
    $dossier = Dossier::with(['client', 'avocat', 'messages', 'documents', 'rendezvous'])->findOrFail($id);
    return view('administration.dossiers.show', compact('dossier'));
}
public function downloadDocument($id)
{
    $document = Document::findOrFail($id);
    return Storage::download($document->chemin, $document->nom);
}

public function deleteDocument($id)
{
    $document = Document::findOrFail($id);
    Storage::delete($document->chemin);
    $document->delete();

    return back()->with('success', 'Document supprimé.');
}
public function uploadDocument(Request $request, $id)
{
    $request->validate([
        'document' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
    ]);

    $dossier = Dossier::findOrFail($id);

    $file = $request->file('document');
    
    // Générer un nom unique pour éviter les conflits
    $nomOriginal = $file->getClientOriginalName();
    $nomUnique = time() . '_' . $nomOriginal;

    // Enregistrer dans storage/app/documents/{dossier_id}/
    $chemin = $file->storeAs("documents/{$dossier->id}", $nomUnique);

    // Enregistrement dans la base de données
    $dossier->documents()->create([
        'nom' => $nomOriginal,  // nom affiché à l'utilisateur
        'path_fichier' => $chemin,    // chemin réel dans storage
    ]);

    return back()->with('success', '✅ Document ajouté avec succès.');
}

public function assignerAvocat(Request $request, Dossier $dossier)
{
    $request->validate([
        'avocat_id' => 'required|exists:avocats,id',
    ]);

    // 1. Assigner l'avocat au dossier
    $dossier->avocat_id = $request->avocat_id;
    $dossier->statut = 'en_cours';
    $dossier->save();

    // 2. Trouver la requête concernée
    $requete = Requete::where('client_id', $dossier->client_id)
                      ->where('domaine_id', $dossier->domaine_id)
                      ->where('statut', 'en_attente')
                      ->latest()
                      ->first();

    if ($requete) {
        $requete->statut = 'acceptee';
        $requete->avocat_id = $request->avocat_id; 
        $requete->save();
    }

    // 3. Notifier avocat
    $avocatUser = $dossier->avocat->user ?? null;
    if ($avocatUser) {
        $avocatUser->notify(new AvocatAssigne($dossier));
    }

    // 4. Notifier client
    $clientUser = $dossier->client->user ?? null;
    if ($clientUser && $requete) {
        $clientUser->notify(new RequeteAcceptee($requete));
    }

    return back()->with('success', 'Avocat assigné, dossier mis en cours et notifications envoyées.');
}


public function documents($id)
{
    $dossier = Dossier::with('documents')->findOrFail($id);

    return view('administration.dossiers.documents', compact('dossier'));
}
// public function changerStatut(Request $request, $id)
// {
//     $request->validate([
//         'statut' => 'required|in:en_attente,en_cours,termine,rejete',
//     ]);

//     $dossier = Dossier::findOrFail($id);

//     // Optionnel : sécurité (seulement admin ou avocat concerné)
//     if (auth()->user()->role === 'avocat' && $dossier->avocat->user_id !== auth()->id()) {
//         abort(403);
//     }

//     $dossier->statut = $request->statut;
//     $dossier->save();

//     return back()->with('success', 'Statut mis à jour avec succès.');
// }
public function changerStatut($id, $statut)
{
    $validStatus = ['en_attente', 'en_cours', 'termine', 'rejete'];
    
    if (!in_array($statut, $validStatus)) {
        return back()->with('error', 'Statut invalide.');
    }

    $dossier = Dossier::where('id', $id)
        ->where('avocat_id', auth()->user()->avocat->id)
        ->firstOrFail();

    $dossier->statut = $statut;
    $dossier->save();

    return back()->with('success', 'Statut mis à jour avec succès.');
}

}
