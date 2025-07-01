<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\RequeteController;
use Illuminate\Support\Facades\Route;

Route::prefix('client')->name('client.')->middleware(['auth', 'role:client', 'verified'])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    Route::get('/attente-validation', [ClientController::class, 'attenteValidation'])->name('attente');

    // Dossiers
    Route::get('/nouveau-dossier', [DossierController::class, 'create'])->name('dossiers.create');
    Route::post('/nouveau-dossier', [DossierController::class, 'store'])->name('dossiers.store');
    Route::get('/mes-dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');

    // Requêtes
    Route::get('/requete', [RequeteController::class, 'create'])->name('requetes.create');
    Route::get('/requete/nouvelle', [RequeteController::class, 'createNouvelleRequete'])->name('requetes.createNouvelleRequete');
    Route::post('/requete', [RequeteController::class, 'store'])->name('requetes.store');
    Route::get('/suivi-dossiers', [ClientController::class, 'suivi'])->name('dossiers.suivi');
    Route::get('/mes-requetes', [RequeteController::class, 'index'])->name('requetes.index');
    Route::get('/client/requetes/{requete}', [RequeteController::class, 'show'])->name('requetes.show');
    Route::get('/mes-documents', [RequeteController::class, 'mesDocuments'])->name('documents.index');
    Route::post('/client/requetes/nouvelle', [RequeteController::class, 'storeNouvelleRequete'])
    ->name('requetes.storeNouvelleRequete');

});
