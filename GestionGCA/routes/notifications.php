
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

/**
 * 📩 Routes Notifications
 */
Route::middleware('auth')->group(function () {

    // Marquer toutes les notifications comme lues
    Route::post('/notifications/mark-all-read', fn() => tap(auth()->user()->unreadNotifications)->markAsRead())
        ->name('notifications.markAllRead');

    // Retourne les dernières notifications au format JSON (ex. menu topbar)
    Route::get('/notifications/json', function () {
        $user = auth()->user();
        $unread = $user->unreadNotifications->take(5)->map(fn($notif) => [
            'message' => $notif->data['message'] ?? 'Nouvelle notification',
            'requete_id' => $notif->data['requete_id'] ?? null,
            'time' => $notif->created_at->diffForHumans(),
        ]);
        return response()->json([
            'count' => $user->unreadNotifications->count(),
            'list' => $unread,
        ]);
    })->name('notifications.json');

    // Marquer une notification comme lue
    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    // (Optionnel) Supprimer une notification
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');
});
