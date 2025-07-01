<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;
     protected $fillable = [
    'dossier_id',
    'type',
    'path_fichier',
  ];


    public function requetes()
    {
        return $this->hasMany(Requete::class);
    }
    public function specialites()
    {
        return $this->hasMany(Specialite::class);
    }

   public function avocats()
   {
       return $this->hasMany(Avocat::class);
   }

}
