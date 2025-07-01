<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['dossier_id', 'expediteur_id', 'destinataire_id', 'contenu', 'lu', 'conversation_id'];

    public function expediteur() {
        return $this->belongsTo(User::class, 'expediteur_id');
    }

    public function destinataire() {
        return $this->belongsTo(User::class, 'destinataire_id');
    }

    public function dossier() {
        return $this->belongsTo(Dossier::class);
    }
    public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

}


