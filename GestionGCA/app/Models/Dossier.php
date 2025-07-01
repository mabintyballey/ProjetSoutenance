<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'avocat_id',
        'domaine_id',
        'statut',
        'description',
        'information_adverse',
    ];

    // Relation vers Client (et non User !)
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // App\Models\Dossier
    public function avocat()
    {
        return $this->belongsTo(Avocat::class, 'avocat_id');
    }

    // Dossier.php
    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function rendezvous()
{
    return $this->hasMany(rendez_vous::class);
}
}