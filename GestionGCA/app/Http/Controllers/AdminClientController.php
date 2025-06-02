<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminClientController extends Controller
{

public function index(Request $request)
{
    $query = User::where('role', 'client');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('prenom', 'like', '%' . $request->search . '%')
              ->orWhere('name', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('sort_by')) {
        $query->orderBy($request->sort_by);
    }
    if ($request->filled('statut')) {
        $query->where('statut_validation', $request->statut);
    }
    $clients = $query->paginate(3);

    return view('administration.clients.index', compact('clients'));
}

public function destroy($id)
{
    $client = User::findOrFail($id);
    $client->delete();

    return back()->with('success', 'Client supprimé.');
}

public function voirDossiers($id)
{
    $client = User::with('dossiersSoumis')->findOrFail($id);
    return view('administration.clients.dossiers', compact('client'));
}

public function attente()
{
    $clients = User::where('role', 'client')->where('statut_validation', 'en_attente')->paginate(10);
    return view('administration.clients.clients', compact('clients'));
}

public function valider($id)
{
    $client = User::findOrFail($id);
    $client->update([
        'statut_validation' => 'valide',
        'is_active' => true
    ]);

    return back()->with('success', 'Client validé avec succès.');
}

public function rejeter($id)
{
    $client = User::findOrFail($id);
    $client->update([
        'statut_validation' => 'rejete',
        'is_active' => false
    ]);

    return back()->with('error', 'Client rejeté.');
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
