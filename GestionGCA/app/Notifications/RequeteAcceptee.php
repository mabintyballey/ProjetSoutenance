<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RequeteAcceptee extends Notification
{
    use Queueable;

    public $requete;

    public function __construct($requete)
    {
        $this->requete = $requete;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre requête a été acceptée')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line('Votre requête a été acceptée par l’administration.')
            ->line('Un avocat vous a été assigné : ' . $this->requete->avocat->prenom . ' ' . $this->requete->avocat->nom)
            ->action('Suivre ma requête', url('/login'))
            ->line('Merci de votre confiance.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Votre requête a été acceptée. Vous pouvez maintenant échanger avec votre avocat.',
            'requete_id' => $this->requete->id,
            'avocat' => $this->requete->avocat->prenom . ' ' . $this->requete->avocat->nom,
        ];
    }
}
