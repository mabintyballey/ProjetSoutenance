<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\User;


class AdminAvocatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    // Commence la requête pour récupérer uniquement les utilisateurs avec le rôle 'avocat'
    $query = User::where('role', 'avocat');

    // Ajoute un filtre de recherche si un terme de recherche est présent
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('prenom', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%")
              ->orWhere('specialite', 'like', "%$search%");
        });
    }

    // Ajoute un filtre pour le tri, si spécifié
    if ($request->filled('sort_by')) {
        $sortField = $request->sort_by;
        if (in_array($sortField, ['name', 'specialite', 'is_active'])) {
            $query->orderBy($sortField);
        }
    }

    // Récupère les avocats avec la pagination
    $avocats = $query->paginate(5)->withQueryString();

    // Retourne la vue avec les avocats récupérés
    return view('administration.avocats.index', compact('avocats'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administration.avocats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);
    
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public'); 
        }
    
        User::create([
            'name' => $validated['name'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'specialite' => $validated['specialite'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
            'password' => bcrypt($validated['password']),
            'role' => 'avocat',
            'is_active' => false,
            'photo' => $photoPath, 
        ]);
    
        return redirect()->route('admin.avocats.index')->with('success', 'Avocat créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $avocat = User::where('role', 'avocat')->findOrFail($id);
        return view('administration.avocats.show', compact('avocat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $avocat = User::where('role', 'avocat')->findOrFail($id);
        return view('administration.avocats.edit', compact('avocat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $avocat = User::where('role', 'avocat')->findOrFail($id);
    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $avocat->id,
            'specialite' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'adresse' => 'required|string|max:255',
        ]);
    
        // Mise à jour manuelle des champs
        $avocat->name = $validated['name'];
        $avocat->prenom = $validated['prenom'];
        $avocat->email = $validated['email'];
        $avocat->specialite = $validated['specialite'];
        $avocat->telephone = $validated['telephone'];
        $avocat->adresse = $validated['adresse'];
    
       if ($request->hasFile('photo')) {
        // Supprimer l’ancienne si elle existe
        if ($avocat->photo && Storage::disk('public')->exists($avocat->photo)) {
            Storage::disk('public')->delete($avocat->photo);
        }
    
        $path = $request->file('photo')->store('photos', 'public');
        $avocat->photo = $path;
        }
    
        $avocat->save();
    
        return redirect()->route('admin.avocats.index')->with('success', 'Avocat mis à jour avec succès.');
    }

//option qui permet à l'admin de bloquer la connexion d'activer ou desactiver le compte d'un avocat
    public function toggleStatus(User $user)
    {
        // Vérifie que c'est bien un avocat
        if ($user->role !== 'avocat') {
            return redirect()->back()->with('error', 'Action non autorisée.');
        }
    
        // Bascule le statut
        $user->is_active = !$user->is_active;
        $user->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $id)
    {
        $avocat = User::where('role', 'avocat')->findOrFail($id);
    
        if ($avocat->dossiersEnCharge()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cet avocat car il a des dossiers. Veuillez transférer les dossiers ou les suspendre.');
        }
    
        // Supprimer la photo si stockée dans un champ par exemple 'photo'
        if ($avocat->photo && Storage::exists($avocat->photo)) {
            Storage::delete($avocat->photo);
        }
    
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
