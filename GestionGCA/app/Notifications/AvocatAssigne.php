<?php

namespace App\Notifications;

use App\Models\Dossier;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class AvocatAssigne extends Notification implements ShouldQueue
{
    use Queueable;

    public $dossier;

    public function __construct(Dossier $dossier)
    {
        $this->dossier = $dossier;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau dossier assigné')
            ->greeting('Bonjour ' . $notifiable->prenom . ',')
            ->line('Un nouveau dossier juridique vous a été assigné.')
            ->line('Client : ' . $this->dossier->client->user->prenom . ' ' . $this->dossier->client->user->nom)
            ->line('Domaine : ' . ($this->dossier->domaine->nom ?? 'Inconnu'))
            ->action('Voir le dossier', url('/avocat/dossiers/' . $this->dossier->id))
            ->line('Merci de traiter ce dossier rapidement.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Un nouveau dossier vous a été assigné.',
            'dossier_id' => $this->dossier->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Un nouveau dossier vous a été assigné.',
            'dossier_id' => $this->dossier->id,
        ]);
    }
}
