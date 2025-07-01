<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AvocatStatusChanged extends Notification
{
    public $status;

    public function __construct($status)
    {
        $this->status = $status; // 'activé' ou 'désactivé'
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Mise à jour de votre compte')
            ->greeting('Bonjour ' . $notifiable->prenom)
            ->line("Votre compte a été **{$this->status}** par l’administrateur.")
            ->line('Si vous avez des questions, veuillez contacter le support.')
            ->salutation('Cordialement, l’équipe administrative');
    }
}
