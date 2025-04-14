<?php

// app/Http/Controllers/DossierController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class DossierController extends Controller
{
    public function index()
    {
        $clients = Client::where('avocat_id', Auth::id())->latest()->get();
        return view('dossiers.index', compact('clients'));
    }

    public function show(Client $client)
    {
        if ($client->avocat_id !== Auth::id()) {
            abort(403);
        }

        return view('dossiers.show', compact('client'));
    }
    public function updateStatut(Request $request, Client $client)
{
    if ($client->avocat_id !== Auth::id()) {
        abort(403);
    }

    $request->validate([
        'statut' => 'required|in:nouveau,en cours,terminé'
    ]);

    $client->update([
        'statut' => $request->statut
    ]);

    return back()->with('success', 'Statut mis à jour avec succès.');
}

}
