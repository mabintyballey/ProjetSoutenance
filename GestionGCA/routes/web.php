<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// gestion des dossiers
Route::middleware(['auth'])->group(function () {
    Route::get('/avocat/dossiers', [DossierController::class, 'index'])->name('dossiers.index');
    Route::get('/avocat/dossiers/{client}', [DossierController::class, 'show'])->name('dossiers.show');
    Route::put('/avocat/dossiers/{client}/statut', [DossierController::class, 'updateStatut'])->name('dossiers.updateStatut');
    
});
require __DIR__.'/auth.php';
Route::view('admin/', 'administration/pages/dashboard')->name('administration.dashboard');
// route client
Route::post('/client-form', [ClientController::class, 'store'])->name('client.store');
