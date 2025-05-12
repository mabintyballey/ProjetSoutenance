<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Dossier;
use Illuminate\Support\Facades\Auth;

class AvocatDossierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dossiers = Dossier::where('avocat_id', Auth::id())->get();
        return view('avocat.dossiers.index', compact('dossiers'));
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
        //
    }

    /**
     * Display the specified resource.
     */
   
     public function show(Dossier $dossier)
     {
         $this->authorize('view', $dossier); // facultatif si tu utilises les Policies
         return view('avocat.dossiers.show', compact('dossier'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function updateStatut(Request $request, Dossier $dossier)
    {
        $request->validate(['statut' => 'required|string']);
        $dossier->update(['statut' => $request->statut]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
