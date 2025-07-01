<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;
    protected $fillable = [
    'client_id',
    'avocat_id',
    'domaine_id',
    'type_aide',
    'probleme',
    'info_adverse',
    'statut',
    'date_statut',
];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
    
    public function avocat()
    {
        return $this->belongsTo(Avocat::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function documents()
    {
        return $this->hasMany(Document::class, 'dossier_id'); // si dossier_id est l'id de la requête
    }

}
