<?php

use App\Http\Controllers\AdminAvocatController;
use App\Http\Controllers\AdminClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AvocatLoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AvocatController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\GestionDossierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('accueil');
Route::view('base/','base');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Redirection dynamique selon le rôle
Route::get('/dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $role = auth()->user()->role ?? null;

    return match ($role) {
        'client' => redirect()->route('client.dashboard'),
        'avocat' => redirect()->route('avocat.dashboard'),
        'admin'  => redirect()->route('admin.dashboard'),
        default  => abort(403),
    };
})->middleware(['auth'])->name('dashboard');

// Deconnexion
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ADMIN LOGIN
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');

// AVOCAT LOGIN
Route::get('/avocat/login', [AvocatLoginController::class, 'showLoginForm'])->name('avocat.login.form');
Route::post('/avocat/login', [AvocatLoginController::class, 'login'])->name('avocat.login');


/**
 * CLIENT ROUTES
 */
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
Route::prefix('client')->name('client.')->middleware(['auth', 'role:client', 'verified'])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');

    // Page de profil obligatoire après inscription
    Route::get('/profile-complet', [ClientController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile-complet', [ClientController::class, 'updateProfile'])->name('profile.update');

    // Page si le compte est encore en attente
    Route::get('/attente-validation', [ClientController::class, 'attenteValidation'])->name('attente');

    // Création de requête juridique
    Route::get('/nouveau-dossier', [DossierController::class, 'create'])->name('dossiers.create');
    Route::post('/nouveau-dossier', [DossierController::class, 'store'])->name('dossiers.store');

    // Voir les dossiers du client
    Route::get('/mes-dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/dossiers/{dossier}', [DossierController::class, 'show'])->name('dossiers.show');
});


/**
 * AVOCAT ROUTES
 */
Route::prefix('avocat')->name('avocat.')->group(function () {
    // Route::get('/login', [AvocatLoginController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [AvocatLoginController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', 'role:avocat'])->group(function () {
        Route::get('/dashboard', [AvocatController::class, 'dashboard'])->name('dashboard');
        Route::resource('/dossiers', GestionDossierController::class);
        Route::get('/clients/{client}/dossier', [DossierController::class, 'show'])->name('dossiers.show');
        Route::put('/clients/{client}/dossier/statut', [DossierController::class, 'updateStatut'])->name('dossiers.updateStatut');
    });
});


/**
 * ADMIN ROUTES
 */
Route::prefix('admin')->name('admin.')->group(function () {
    // Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
         Route::get('/admin/clients', [AdminClientController::class, 'index'])->name('admin.clients');
    Route::post('/admin/clients/{id}/valider', [AdminClientController::class, 'valider'])->name('admin.clients.valider');
    Route::post('/admin/clients/{id}/rejeter', [AdminClientController::class, 'rejeter'])->name('admin.clients.rejeter');
        Route::resource('/utilisateurs', UserManagementController::class);
    });
});
// route gestion des avocats par admin
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('avocats', [AdminAvocatController::class, 'index'])->name('admin.avocats.index');
    Route::get('avocats/create', [AdminAvocatController::class, 'create'])->name('admin.avocats.create');
    Route::post('avocats', [AdminAvocatController::class, 'store'])->name('admin.avocats.store');
    Route::get('avocats/{id}', [AdminAvocatController::class, 'show'])->name('admin.avocats.show');
    Route::get('avocats/{id}/edit', [AdminAvocatController::class, 'edit'])->name('admin.avocats.edit');
    Route::put('avocats/{id}', [AdminAvocatController::class, 'update'])->name('admin.avocats.update');
    // Supprimer un avocat (protégé par condition des dossiers)
    Route::delete('avocats/{id}', [AdminAvocatController::class, 'destroy'])->name('admin.avocats.destroy');
    Route::post('/admin/avocats/{user}/toggle', [AdminAvocatController::class, 'toggleStatus'])->name('admin.avocats.toggle');
    // LES ROUTES CLIENT ADMIN
    Route::get('clients', [AdminClientController::class, 'attente'])->name('admin.clients.attente');
    Route::post('clients/{id}/valider', [AdminClientController::class, 'valider'])->name('admin.clients.valider');
    Route::post('clients/{id}/rejeter', [AdminClientController::class, 'rejeter'])->name('admin.clients.rejeter');
    // Liste des clients
    Route::get('admin/clients', [AdminClientController::class, 'index'])->name('admin.clients.index');
    
    // Supprimer un client
    Route::delete('admin/clients/{id}', [AdminClientController::class, 'destroy'])->name('admin.clients.destroy');
    
    // Page des clients en attente
    Route::get('admin/clients/attente', [AdminClientController::class, 'attente'])->name('admin.clients.attente');
    // PDF
    Route::get('clients/{id}/dossiers/pdf', [AdminClientController::class, 'exporterDossiersPDF'])->name('admin.clients.dossiers.pdf');
    // Liste de tous les dossiers
    Route::get('/admin/dossiers', [DossierController::class, 'index'])->name('admin.dossiers.index');

    // Détails d’un dossier
    Route::get('/admin/dossiers/{id}', [DossierController::class, 'show'])->name('admin.dossiers.show');
    
    // Tous les dossiers d’un client
     Route::get('admin/clients/{id}/dossiers', [AdminClientController::class, 'voirDossiers'])->name('admin.clients.dossiers');

});


/**
 * DOSSIERS (gérés par les avocats)
 */
Route::middleware(['auth', 'role:avocat'])->group(function () {
    Route::get('/avocat/dossiers', [DossierController::class, 'index'])->name('avocat.dossiers.index');
    Route::get('/avocat/dossiers/{client}', [DossierController::class, 'show'])->name('avocat.dossiers.show');
    Route::put('/avocat/dossiers/{client}/statut', [DossierController::class, 'updateStatut'])->name('avocat.dossiers.updateStatut');
});

// Pages statiques
Route::view('/contact', 'partials.contact')->name('contact');

require __DIR__.'/auth.php';
