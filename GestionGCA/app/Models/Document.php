<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'dossier_id',
        'type',
        'path_fichier',
    ];
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
    public function requete()
   {
       return $this->belongsTo(Requete::class, 'dossier_id');
   }

}
