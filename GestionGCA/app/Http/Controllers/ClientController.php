<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string',
            'piece_identite' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',

            'type_service' => 'required|string',
            'probleme' => 'required|string',

            'documents.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'adverse_info' => 'required|string'
        ]);

        // Stocker la pièce d'identité
        $pieceIdentitePath = $request->file('piece_identite')->store('pieces_identite', 'public');

        // Stocker les documents multiples
        $documentPaths = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $document) {
                $documentPaths[] = $document->store('documents', 'public');
            }
        }

        // Sauvegarde dans la base
        $client = Client::create([
            'nom' => $validated['nom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'],
            'piece_identite' => $pieceIdentitePath,
            'type_service' => $validated['type_service'],
            'probleme' => $validated['probleme'],
            'documents' => json_encode($documentPaths),
            'adverse_info' => $validated['adverse_info'],
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
