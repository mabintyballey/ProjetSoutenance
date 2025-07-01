<?php

namespace App\Notifications;

use App\Models\Requete;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NouvelleRequeteSoumise extends Notification implements ShouldQueue
{
    use Queueable;

    public $requete;

    public function __construct(Requete $requete)
    {
        $this->requete = $requete;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // ou juste 'database' si tu veux seulement dans le dashboard
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Nouvelle requête soumise')
                    ->greeting('Bonjour Admin,')
                    ->line('Un client vient de soumettre une nouvelle requête juridique.')
                    ->line('Nom du client : ' . $this->requete->client->user->prenom . ' ' . $this->requete->client->user->nom)
                    ->line('Domaine : ' . $this->requete->type_aide)
                    ->action('Voir la requête', url('/admin/requetes')) 
                    ->line('Merci d’utiliser notre plateforme.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Nouvelle requête soumise par ' . $this->requete->client->user->prenom . ' ' . $this->requete->client->user->nom,
            'requete_id' => $this->requete->id,
        ];
    }
    
}
