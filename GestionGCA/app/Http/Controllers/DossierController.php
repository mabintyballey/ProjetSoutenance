<?php

namespace App\Http\Controllers;
use App\Models\Dossier;
use Illuminate\Http\Request;

class DossierController extends Controller
{

      public function index(Request $request)
    {
        $query = Dossier::with(['client', 'avocat']);

        if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
        }

        if ($request->filled('type_affaire')) {
            $query->where('type_affaire', $request->type_affaire);
        }

        $dossiers = $query->latest()->paginate(10);
        // pour les filtres dynamiques
       $types_affaires = Dossier::select('type_affaire')->distinct()->pluck('type_affaire');

        $stats = [
         'total' => Dossier::count(),
         'valide' => Dossier::where('statut', 'validé')->count(),
         'attente' => Dossier::where('statut', 'en_attente')->count(),
         'rejete' => Dossier::where('statut', 'rejeté')->count(),
        ];
        return view('administration.dossiers.index', compact('dossiers','stats', 'types_affaires'));
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

}
