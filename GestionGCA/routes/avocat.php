<?php

use App\Http\Controllers\Auth\AvocatLoginController;
use App\Http\Controllers\AvocatController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\GestionDossierController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Routes AVOCAT
Route::prefix('avocat')->name('avocat.')->middleware(['auth', 'role:avocat'])->group(function () {
    Route::get('/dashboard', [AvocatController::class, 'dashboard'])->name('dashboard');
    // Liste des clients pour un avocat
    Route::get('/clients', [AvocatController::class, 'mesClients'])->name('avocat.clients');

    // Liste des dossiers de l’avocat
    Route::get('/mes-dossiers', [AvocatController::class, 'index'])->name('dossiers.mes');

    // Changer le statut du dossier
    Route::get('/dossiers/{id}/changer-statut/{statut}', [DossierController::class, 'changerStatut'])->name('dossiers.changerStatut');

    // Voir les dossiers d’un client (optionnel)
    Route::get('/clients/{id}/dossiers', [AvocatController::class, 'dossiersClient'])->name('clients.dossiers');

    // Voir messagerie liée à un dossier
    Route::get('/messagerie/dossier/{id}', [MessageController::class, 'indexParDossier'])->name('messagerie.dossier');

    // Dossiers - CRUD
    Route::resource('/dossiers', GestionDossierController::class);
    Route::get('/clients/{client}/dossier', [DossierController::class, 'show'])->name('clients.dossier.show');

});
