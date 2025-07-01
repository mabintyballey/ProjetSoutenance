<?php
namespace App\Http\Controllers;

use App\Mail\AvocatInscription;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Domaine;
use App\Models\Specialite;
use App\Notifications\AvocatStatusChanged;

class AdminAvocatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    // Base : utilisateurs avec rôle avocat et relations
    $query = User::where('role', 'avocat')->with(['avocat.specialite', 'avocat.domaine']);

    // 🔍 Recherche globale
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nom', 'like', "%$search%")
              ->orWhere('prenom', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhereHas('avocat.specialite', function ($sq) use ($search) {
                  $sq->where('nom', 'like', "%$search%");
              })
              ->orWhereHas('avocat.domaine', function ($sq) use ($search) {
                  $sq->where('nom', 'like', "%$search%");
              });
        });
    }

    // 🎯 Filtre par domaine
    if ($request->filled('domaine_id')) {
        $query->whereHas('avocat', function ($q) use ($request) {
            $q->where('domaine_id', $request->domaine_id);
        });
    }

    // 🔃 Tri personnalisé
    if ($request->filled('sort_by')) {
        $sortField = $request->sort_by;

        if ($sortField === 'is_active') {
            $query->join('avocats', 'users.id', '=', 'avocats.user_id')
                  ->orderBy('avocats.is_active')
                  ->select('users.*');
        } elseif ($sortField === 'specialite') {
            $query->join('avocats', 'users.id', '=', 'avocats.user_id')
                  ->join('specialites', 'avocats.specialite_id', '=', 'specialites.id')
                  ->orderBy('specialites.nom')
                  ->select('users.*');
        } else {
            $query->orderBy($sortField);
        }
    }

    // 📄 Pagination
    $avocats = $query->paginate(6)->withQueryString();
    $domaines = Domaine::all(); // pour le filtre dans la vue

    return view('administration.avocats.index', compact('avocats', 'domaines'));
}





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {     
         $domaines = Domaine::with('specialites')->get();
        return view('administration.avocats.create', compact('domaines'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'telephone' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'password' => 'required|string|min:8',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'domaine_id' => 'required|exists:domaines,id',
        'specialite_id' => 'nullable|exists:specialites,id',
    ]);

    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    }

    $plainPassword = $validated['password'];

    // Création de l'utilisateur
    $user = User::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
        'adresse' => $validated['adresse'],
        'password' => bcrypt($validated['password']),
        'role' => 'avocat',
        'photo' => $photoPath,
    ]);

    // Création de l'avocat lié à l'utilisateur
    $user->avocat()->create([
        'domaine_id' => $validated['domaine_id'],
        'specialite_id' => $validated['specialite_id'],
        'is_active' => true,
    ]);

    // Envoi du mail de bienvenue
    Mail::to($user->email)->send(new AvocatInscription($user->name, $user->email, $plainPassword));

    return redirect()->route('admin.avocats.index')->with('success', 'Avocat créé avec succès.');
}


    /**
     * Display the specified resource.
     */
  public function show(string $id)
{
    $avocat = User::with(['avocat.domaine', 'avocat.specialite'])->where('role', 'avocat')->findOrFail($id);

    // Sinon, retourne la vue complète classique (optionnel)
    return view('administration.avocats.show', compact('avocat'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $avocat = User::with('avocat')->findOrFail($id);
        $domaines = Domaine::all();
        $specialites = Specialite::where('domaine_id', $avocat->avocat->domaine_id ?? null)->get();
    
        return view('administration.avocats.edit', compact('avocat', 'domaines', 'specialites'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    
    if ($user->role !== 'avocat') {
        abort(403, "Ce compte n'est pas un avocat.");
    }

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'telephone' => 'required|string|max:20',
        'adresse' => 'required|string|max:255',
        'domaine_id' => 'required|exists:domaines,id',
        'specialite_id' => 'nullable|exists:specialites,id',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Mise à jour des champs User
    $user->update([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
        'adresse' => $validated['adresse'],
    ]);

    // Gestion de la photo
    if ($request->hasFile('photo')) {
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->photo = $request->file('photo')->store('photos', 'public');
        $user->save();
    }

    // Mise à jour des données Avocat
    $avocat = $user->avocat; // Relation 1-1 User → Avocat
    if ($avocat) {
        $avocat->update([
            'domaine_id' => $validated['domaine_id'],
            'specialite_id' => $validated['specialite_id'],
        ]);
    }

    return redirect()->route('admin.avocats.index')->with('success', 'Avocat mis à jour avec succès.');
}
//option qui permet à l'admin de bloquer la connexion d'activer ou desactiver le compte d'un avocat

public function toggleStatus(User $user)
{
    if ($user->role !== 'avocat') {
        return redirect()->back()->with('error', 'Action non autorisée.');
    }

    $avocat = $user->avocat;

    if (!$avocat) {
        return redirect()->back()->with('error', 'Avocat non trouvé.');
    }

    // Bascule
    $avocat->is_active = !$avocat->is_active;
    $avocat->save();

    $newStatus = $avocat->is_active ? 'activé' : 'désactivé';

    // Envoie notification
    $user->notify(new AvocatStatusChanged($newStatus));

    return redirect()->back()->with('success', "Le compte de l’avocat a été {$newStatus}.");
}



    /**
     * Remove the specified resource from storage.
     */
 public function destroy(string $id)
{
    $avocat = User::where('role', 'avocat')->findOrFail($id);

    // Vérifier s’il peut être supprimé
    if ($avocat->avocat && !$avocat->avocat->peutEtreSupprime()) {
        // On envoie une valeur technique dans la session
        return redirect()->back()->with('error', 'avocat_a_dossiers');
    }

    // Supprimer la photo si elle existe
    if ($avocat->photo && Storage::exists($avocat->photo)) {
        Storage::delete($avocat->photo);
    }

    // Supprimer l’utilisateur
    $avocat->delete();

    return redirect()->route('admin.avocats.index')->with('success', 'Avocat supprimé avec succès.');
}


    public function transferDossiers(Request $request, $id)
    {
        $ancien = User::where('role', 'avocat')->findOrFail($id);
        $nouveauId = $request->input('nouvel_avocat_id');
    
        $nouveau = User::where('role', 'avocat')->findOrFail($nouveauId);
    
        foreach ($ancien->dossiers as $dossier) {
            $dossier->avocat_id = $nouveau->id;
            $dossier->save();
        }
    
        return redirect()->back()->with('success', 'Dossiers transférés avec succès à ' . $nouveau->name);
    }
    
    public function suspendDossiers($id)
    {
        $avocat = User::where('role', 'avocat')->findOrFail($id);
    
        foreach ($avocat->dossiers as $dossier) {
            $dossier->statut = 'suspendu';
            $dossier->save();
    
            // Optionnel : Notifier le client
            // Notification::route('mail', $dossier->client->email)->notify(new DossierSuspendu($dossier));
        }
    
        return redirect()->back()->with('success', 'Tous les dossiers ont été suspendus et les clients notifiés.');
    }
 

}
