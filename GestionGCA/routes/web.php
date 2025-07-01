<?php
// routes/web.php

require __DIR__.'/auth.php';
require __DIR__.'/client.php';
require __DIR__.'/avocat.php';
require __DIR__.'/admin.php';
require __DIR__.'/messagerie.php';
require __DIR__.'/notifications.php';

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AvocatLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\SpecialiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', fn () => view('home'))->name('accueil');
Route::view('base/', 'base');
Route::get('/', [HomeController::class, 'index'])->name('accueil');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
// ADMIN
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// AVOCAT
Route::get('/avocat/login', [AvocatLoginController::class, 'showLoginForm'])->name('avocat.login.form');
Route::post('/avocat/login', [AvocatLoginController::class, 'login'])->name('avocat.login');

Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');
    return match (auth()->user()->role ?? null) {
        'client' => redirect()->route('client.dashboard'),
        'avocat' => redirect()->route('avocat.dashboard'),
        'admin'  => redirect()->route('admin.dashboard'),
        default  => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::get('/rendezvous/create', [RendezVousController::class, 'create'])->name('rendezvous.create');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store');
    Route::get('/rendezvous/{rendezvous}', [RendezVousController::class, 'show'])->name('rendezvous.show');
    Route::get('/rendezvous/{id}/accepter', [RendezVousController::class, 'accepter'])->name('rendezvous.accepter');
    Route::get('/rendezvous/{id}/rejeter', [RendezVousController::class, 'rejeter'])->name('rendezvous.rejeter');
    Route::get('/rendezvous/{id}/confirmer', [RendezVousController::class, 'confirmer'])->name('rendezvous.confirmer');
    Route::get('/rendezvous/{id}/edit', [RendezVousController::class, 'edit'])->name('rendezvous.edit'); // pour demander modif
    Route::patch('/rendezvous/{rendezvous}/update-statut', [RendezVousController::class, 'updateStatut'])
     ->name('rendezvous.updateStatut');
    Route::put('rendezvous/{id}', [RendezVousController::class, 'update'])->name('rendezvous.update');

});
Route::get('/admin/domaine/{domaine}/specialites', [SpecialiteController::class, 'getSpecialites'])
     ->name('admin.domaine.specialites');

