<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    // Vue principale des conversations
    Route::get('/messagerie', [MessageController::class, 'index'])->name('messagerie.index');
    Route::get('/messagerie/message/{id}', [MessageController::class, 'show'])->name('messagerie.show');

    // Créer une nouvelle conversation (formulaire et enregistrement)
    Route::get('/messagerie/create', [MessageController::class, 'create'])->name('messagerie.create');
    Route::post('/messagerie/conversation', [MessageController::class, 'storeConversation'])->name('messagerie.conversation.store');

    // Rafraîchir via AJAX
    Route::get('/messagerie/ajax/refresh', [MessageController::class, 'loadConversationsAjax'])->name('messagerie.refresh');

    // Redirection vers conversation par dossier
    Route::get('/messagerie/dossier/{dossier}', [MessageController::class, 'redirigerVersConversation'])->name('messagerie.dossier');

    // Messagerie avec un utilisateur
    Route::get('/messagerie/conversation/{conversation}', [MessageController::class, 'chat'])->name('messagerie.chat');
    Route::post('/messagerie/ajax/send', [MessageController::class, 'sendAjax'])->name('messagerie.sendAjax');
    Route::get('/messagerie/ajax/conversation/{user}', [MessageController::class, 'loadAjaxMessages'])->name('messagerie.loadAjax');

    // Envoyer un message
    Route::post('/messagerie/envoyer', [MessageController::class, 'envoyerMessage'])->name('messagerie.envoyer');
    Route::post('/messagerie/send', [MessageController::class, 'sendAjax']); // doublon possible à vérifier

    // Marquer comme lus
    Route::post('/messagerie/lus', [MessageController::class, 'marquerTousLus'])->name('messagerie.lus');

// routes/web.php
Route::delete('/messagerie/conversation/{conversation}', [MessageController::class, 'destroyConversation'])->name('messagerie.conversation.destroy');


});
