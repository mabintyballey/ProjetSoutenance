<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Conversation;
use App\Models\Dossier;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AvocatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $avocatId = auth()->user()->avocat->id;

    $query = Dossier::with(['client.user', 'domaine'])
        ->where('avocat_id', $avocatId);

    if (request('domaine_id')) {
        $query->where('domaine_id', request('domaine_id'));
    }

    if (request('statut')) {
        $query->where('statut', request('statut'));
    }

    $dossiers = $query->latest()->paginate(6);
    $domaines = Domaine::all();
    // dd($dossiers);

    return view('avocat.dossiers.index', compact('dossiers', 'domaines'));
}



    /**
     * Show the form for creating a new resource.


    
     * Display the specified resource.
     */

    public function show(string $id)
    {
        //
    }
     

public function dashboard()
{
    $avocat = auth()->user()->avocat;
    if (!$avocat) {
        abort(403, 'Non autorisé');
    }

    // Nombre de dossiers en cours
    $activeCases = $avocat->dossiers()->where('statut', 'en_cours')->count();

    // Nombre de dossiers terminés
    $closedCases = $avocat->dossiers()->where('statut', 'termine')->count();

    // Total dossiers (tous statuts confondus)
    $totalDossiers = $avocat->dossiers()->count();

    // Nombre de clients distincts liés à cet avocat
    $myClients = Client::whereHas('dossiers', fn($q) => $q->where('avocat_id', $avocat->id))
                        ->distinct('id')->count('id');

    // Nombre de dossiers créés par mois (pour les 12 mois)
    $casesPerMonth = $avocat->dossiers()
        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    $monthlyCases = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyCases[] = $casesPerMonth[$i] ?? 0;
    }

    // Récupération des rendez-vous pour le calendrier
    $events = $avocat->rendezvous()->get()->map(function ($rdv) {
        return [
            'title' => "RDV: " . substr($rdv->description ?? 'Sans description', 0, 20),
            'start' => $rdv->date_heure->toDateTimeString(),
            'color' => '#aa9166',
        ];
    });

    return view('avocat.pages.dashboard', compact(
        'activeCases',
        'closedCases',
        'totalDossiers',
        'myClients',
        'monthlyCases',
        'events'
    ));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
  public function mesClients()
{
    $avocat = auth()->user()->avocat;

    $dossiers = Dossier::with('client.user')
        ->where('avocat_id', $avocat->id)
        ->get();

    $clientsUniques = $dossiers
        ->groupBy('client_id')
        ->map(function ($group) {
            $client = $group->first()->client->user;
            $client->dernier_dossier_id = $group->first()->id;
            return $client;
        })->values();

    // Paginer manuellement après transformation
    $perPage = 4;
    $page = request()->get('page', 1);
    $paged = $clientsUniques->forPage($page, $perPage);
    $clients = new \Illuminate\Pagination\LengthAwarePaginator(
        $paged,
        $clientsUniques->count(),
        $perPage,
        $page,
        ['path' => request()->url(), 'query' => request()->query()]
    );

    return view('avocat.clients.clients', compact('clients'));
}


public function dossiersClient($id)
{
    $avocat = Auth::user()->avocat;

    $client = Client::with(['user', 'dossiers.documents'])
        ->where('user_id', $id)
        ->firstOrFail();

    $dossiers = $client->dossiers()
        ->where('avocat_id', $avocat->id)
        ->with('documents')
        ->paginate(5); 

    return view('avocat.dossiers.dossiersClient', compact('client', 'dossiers'));
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
