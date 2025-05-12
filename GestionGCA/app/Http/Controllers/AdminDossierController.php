<?php

namespace App\Http\Controllers;

use App\Models\Dossier;

class AdminDossierController extends Controller
{
    public function index()
    {
        $dossiers = Dossier::with(['client', 'avocat'])->latest()->get();
        return view('admin.dossiers.index', compact('dossiers'));
    }

    public function show(Dossier $dossier)
    {
        return view('admin.dossiers.show', compact('dossier'));
    }
}
