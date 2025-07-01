<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Notifications\NouvelleRequeteSoumise;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Document;
use App\Models\Client;
use App\Models\Requete;
use App\Models\Domaine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class RequeteController extends Controller
{
    public function create()
    {
        $domaines = Domaine::all(); // ou Domaine::orderBy('nom')->get();
        return view('client.requete.create', compact('domaines'));
    }
    public function index(Request $request)
{
    $client = auth()->user()->client;
    
    $query = Requete::with(['avocat.user', 'domaine'])
        ->where('client_id', $client->id);

    // 🔎 Filtres
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    if ($request->filled('domaine')) {
        $query->where('domaine_id', $request->domaine);
    }

    $requetes = $query->latest()->paginate(5);
    $domaines = Domaine::all();

    return view('client.requete.index', compact('requetes', 'domaines'));
}
public function mesDocuments()
{
    $client = auth()->user()->client;

    // Récupérer tous les documents des dossiers du client
    $documents = Document::whereHas('dossier', function ($query) use ($client) {
        $query->where('client_id', $client->id);
    })->with('dossier')
      ->latest()
      ->paginate(6);

    return view('client.documents.index', compact('documents'));
}
    public function createNouvelleRequete()
    {
        $domaines = Domaine::all(); // ou Domaine::orderBy('nom')->get();
        return view('client.requete.nouvelleRequete', compact('domaines'));
    }
public function store(Request $request)
{
    $request->validate([
        'type_aide' => 'required|exists:domaines,id',
        'probleme' => 'required|string|max:5000',
        'info_adverse' => 'required|string|max:5000',
        'documents.*' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
    ]);

    $client = Client::where('user_id', Auth::id())->firstOrFail();

    $domaine = Domaine::findOrFail($request->type_aide);

    $requete = Requete::create([
        'client_id' => $client->id,
        'domaine_id' => $domaine->id,
        'type_aide' => $domaine->nom,
        'probleme' => $request->probleme,
        'info_adverse' => $request->info_adverse,
    ]);

    $dossier = Dossier::create([
        'client_id' => $client->id,
        'domaine_id' => $domaine->id,
        'description' => $request->probleme,
        'information_adverse' => $request->info_adverse,
        'statut' => 'en_attente',
    ]);

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $fichier) {
            $nom = time() . '_' . Str::slug(pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME))
                . '.' . $fichier->getClientOriginalExtension();

            $fichier->storeAs('public/documents', $nom);

            Document::create([
                'dossier_id' => $dossier->id,
                'type' => 'preuve',
                'path_fichier' => $nom,
            ]);
        }
    }

    // ✅ Notification aux admins
    $admins = User::where('role', 'admin')->get();
    Notification::send($admins, new NouvelleRequeteSoumise($requete));

    // Déconnexion
    Auth::logout();

    return redirect()->route('login')->with('info', 'Votre requête a été soumise avec succès. Veuillez attendre la validation de l’administration.');
}

public function storeNouvelleRequete(Request $request)
{
    $request->validate([
        'type_aide' => 'required|exists:domaines,id',
        'probleme' => 'required|string|max:5000',
        'info_adverse' => 'required|string|max:5000',
        'documents.*' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
    ]);

    $client = Client::where('user_id', Auth::id())->firstOrFail();

    $domaine = Domaine::findOrFail($request->type_aide);

    $requete = Requete::create([
        'client_id' => $client->id,
        'domaine_id' => $domaine->id,
        'type_aide' => $domaine->nom,
        'probleme' => $request->probleme,
        'info_adverse' => $request->info_adverse,
    ]);

    $dossier = Dossier::create([
        'client_id' => $client->id,
        'domaine_id' => $domaine->id,
        'description' => $request->probleme,
        'information_adverse' => $request->info_adverse,
        'statut' => 'en_attente',
    ]);

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $fichier) {
            $nom = time() . '_' . Str::slug(pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME))
                . '.' . $fichier->getClientOriginalExtension();

            $fichier->storeAs('public/documents', $nom);

            Document::create([
                'dossier_id' => $dossier->id,
                'type' => 'preuve',
                'path_fichier' => $nom,
            ]);
        }
    }

    // ✅ Notification aux admins
    $admins = User::where('role', 'admin')->get();
    Notification::send($admins, new NouvelleRequeteSoumise($requete));


     return redirect()->route('client.requetes.create')
        ->with('info', 'Votre requête a été soumise avec succès. Veuillez attendre la validation de l’administration.');
}
public function show($id)
{
    $requete = Requete::with('client.user', 'domaine')->findOrFail($id);

    // Récupère tous les utilisateurs ayant le rôle 'avocat'
    $avocats = User::where('role', 'avocat')
               ->whereHas('avocat', fn($q) => $q->where('is_active', true))
               ->get();

    return view('administration.requetes.show', compact('requete', 'avocats'));
}


}
