<?php

namespace App\Http\Controllers;

use App\Models\rendez_vous;
use App\Models\Dossier;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{

    public function index()
{
    $user = Auth::user();

    if ($user->role === 'avocat') {
        $rendezvous = rendez_vous::with(['dossier.avocat.user', 'dossier.client.user'])
            ->whereHas('dossier', function ($q) use ($user) {
                $q->where('avocat_id', $user->avocat->id);
            })
            ->latest()
            ->paginate(6);

    } elseif ($user->role === 'client') {
        $rendezvous = rendez_vous::with(['dossier.avocat.user', 'dossier.client.user'])
            ->whereHas('dossier', function ($q) use ($user) {
                $q->where('client_id', $user->client->id);
            })
            ->latest()
            ->paginate(6);

    } else {
        abort(403, "Accès refusé.");
    }

    return view('rendezvous.index', compact('rendezvous'));
}


    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'avocat') {
            $clients = Client::whereHas('dossiers', function ($q) use ($user) {
                $q->where('avocat_id', $user->avocat->id);
            })->with('user', 'dossiers')->get();

        } elseif ($user->role === 'client') {
            abort(403, "Les clients ne peuvent pas créer un rendez-vous.");

        } else {
            abort(403);
        }

        return view('rendezvous.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dossier_id' => 'required|exists:dossiers,id',
            'date_heure' => 'required|date|after:now',
            'lieu' => 'nullable|string|max:255',
            'motif' => 'nullable|string|max:2000',
        ]);

        $user = Auth::user();
        $dossier = Dossier::findOrFail($request->dossier_id);

        if ($user->role === 'avocat' && $dossier->avocat_id !== $user->avocat->id) {
            abort(403, "Ce dossier ne vous appartient pas.");
        }

        rendez_vous::create([
            'dossier_id' => $dossier->id,
            'date_heure' => $request->date_heure,
            'lieu' => $request->lieu,
            'motif' => $request->motif,
            'statut' => 'en_attente',
        ]);

        return redirect()->route('rendezvous.index')->with('success', 'Rendez-vous créé avec succès !');
    }

    public function show(rendez_vous $rendezvous)
    {
        // L'autorisation est gérée par la policy grâce à authorizeResource

        return view('rendezvous.show', compact('rendezvous'));
    }

  public function edit($id)
{
    $rendezvous = rendez_vous::findOrFail($id);

    $this->authorize('update', $rendezvous);

    return view('rendezvous.edit', compact('rendezvous'));
}


    public function update(Request $request, rendez_vous $rendezvous)
    {
        $request->validate([
            'date_heure' => 'required|date|after:now',
            'lieu' => 'required|string|max:255',
            'motif' => 'nullable|string|max:2000',
        ]);

        $rendezvous->update([
            'date_heure' => $request->date_heure,
            'lieu' => $request->lieu,
            'motif' => $request->motif,
            'statut' => 'modifie',
        ]);

        return redirect()->route('rendezvous.index')
                         ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    // Met à jour le statut (accepté, rejeté, modifié) par client ou avocat
    public function updateStatut(Request $request, rendez_vous $rendezvous)
    {
        $request->validate([
            'statut' => 'required|in:accepte,rejete,modifie'
        ]);

        $rendezvous->statut = $request->statut;

        if ($request->statut === 'modifie' && $request->motif) {
            $rendezvous->motif = $request->motif;
        }

        $rendezvous->save();

        return redirect()->route('rendezvous.index')->with('success', 'Statut mis à jour.');
    }

    public function accepter(rendez_vous $rendezvous)
    {
        $rendezvous->update(['statut' => 'accepte']);
        return back()->with('success', 'Rendez-vous accepté !');
    }

    public function rejeter(rendez_vous $rendezvous)
    {
        $rendezvous->update(['statut' => 'rejete']);
        return back()->with('success', 'Rendez-vous rejeté.');
    }

    public function confirmer(rendez_vous $rendezvous)
    {
        // Utilisé pour confirmer la modification par l’avocat
        $rendezvous->update(['statut' => 'accepte']);
        return back()->with('success', 'Modification confirmée !');
    }
}
