<?php

use App\Http\Controllers\AdminAvocatController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDossierController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AdminRequeteController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\RequeteController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    // Clients
    Route::get('/clients', [AdminClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/attente', [AdminClientController::class, 'attente'])->name('clients.attente');
    Route::post('/clients/{id}/valider', [AdminClientController::class, 'valider'])->name('clients.valider');
    Route::post('/clients/{id}/rejeter', [AdminClientController::class, 'rejeter'])->name('clients.rejeter');
    Route::get('/clients/{id}/dossiers', [AdminClientController::class, 'voirDossiers'])->name('clients.dossiers');
    Route::get('/clients/{id}/dossiers/pdf', [AdminClientController::class, 'exporterDossiersPDF'])->name('clients.dossiers.pdf');
    Route::delete('/clients/{id}', [AdminClientController::class, 'destroy'])->name('clients.destroy');

    // Avocats
    Route::get('/avocats', [AdminAvocatController::class, 'index'])->name('avocats.index');
    Route::get('/avocats/create', [AdminAvocatController::class, 'create'])->name('avocats.create');
    Route::post('/avocats', [AdminAvocatController::class, 'store'])->name('avocats.store');
    Route::get('/avocats/{id}/edit', [AdminAvocatController::class, 'edit'])->name('avocats.edit');
    Route::get('/avocats/{id}', [AdminAvocatController::class, 'show'])->name('avocats.show');
    Route::put('/avocats/{id}', [AdminAvocatController::class, 'update'])->name('avocats.update');
    Route::delete('/avocats/{id}', [AdminAvocatController::class, 'destroy'])->name('avocats.destroy');
    Route::post('/avocats/{user}/toggle', [AdminAvocatController::class, 'toggleStatus'])->name('avocats.toggle');

    // Dossiers
    Route::get('/dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/dossiers/{id}', [DossierController::class, 'show'])->name('dossiers.show');
    Route::put('/clients/{client}/dossier/statut', [DossierController::class, 'updateStatut'])->name('dossiers.updateStatut');
    Route::post('/dossiers/{id}/upload', [DossierController::class, 'uploadDocument'])->name('documents.upload');
    Route::get('/documents/{id}/download', [DossierController::class, 'downloadDocument'])->name('documents.telecharger');
    Route::delete('/documents/{id}', [DossierController::class, 'deleteDocument'])->name('documents.supprimer');
    Route::get('/dossiers/{id}/telecharger-zip', [AdminDossierController::class, 'telechargerZip'])->name('dossiers.telechargerZip');
    Route::post('/dossiers/{dossier}/assigner', [DossierController::class, 'assignerAvocat'])->name('dossiers.assignerAvocat');

    // Requêtes
    Route::get('/requêtes', [AdminRequeteController::class, 'index'])->name('requetes.index');
    // Requêtes pour Admin
    Route::get('/requête/{id}', [AdminRequeteController::class, 'show'])->name('requetes.show');

    // Requêtes pour un usage spécifique (renommée)
    Route::get('/requetes/{id}', [RequeteController::class, 'show'])->name('requetes.public.show');

    Route::post('/requête/{id}/assigner', [AdminRequeteController::class, 'assignerAvocat'])->name('requetes.assigner');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/discussions', [AdminMessageController::class, 'index'])->name('admin.discussions.index');
    Route::get('/admin/discussions/dossier/{id}', [AdminMessageController::class, 'show'])->name('admin.discussions.show');
});
