<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index()
{
    $clients = User::where('role', 'client')
                    ->where('statut_validation', 'en_attente')
                    ->get();

    return view('admin.clients', compact('clients'));
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

}
