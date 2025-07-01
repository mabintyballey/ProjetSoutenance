<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead();
    
        // Redirection vers la requête liée (ou autre action logique)
        return redirect()->route('admin.requetes.show', $notification->data['requete_id']);
    }
}
