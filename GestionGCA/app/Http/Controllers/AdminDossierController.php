<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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
 

public function telechargerZip($id)
{
    $dossier = Dossier::with('documents')->findOrFail($id);

    if ($dossier->documents->isEmpty()) {
        return back()->with('error', 'Aucun document à télécharger pour ce dossier.');
    }

    $zipFileName = "dossier_documents_{$dossier->id}.zip";
    $zipPath = storage_path("app/public/tmp/{$zipFileName}");

    // Créer le dossier temporaire s’il n’existe pas
    if (!file_exists(storage_path('app/public/tmp'))) {
        mkdir(storage_path('app/public/tmp'), 0777, true);
    }

    $zip = new ZipArchive;
    if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        foreach ($dossier->documents as $doc) {
            $absolutePath = storage_path("app/" . $doc->chemin);
            if (file_exists($absolutePath)) {
                $zip->addFile($absolutePath, basename($doc->chemin));
            }
        }
        $zip->close();

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    return back()->with('error', 'Erreur lors de la création du fichier ZIP.');
}

}
