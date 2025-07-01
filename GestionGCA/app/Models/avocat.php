<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avocat extends Model
{
    use HasFactory;
     protected $fillable = [
    'user_id',
    'domaine_id',
    'specialite_id',
    'is_active',
   ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
    
    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }
      public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }
    // App\Models\Avocat.php

    public function dossiersEnCharge()
    {
        return $this->hasMany(Dossier::class, 'avocat_id');
    }
public function rendezvous()
{
    return $this->hasManyThrough(rendez_vous::class, Dossier::class, 'avocat_id', 'dossier_id', 'id', 'id');
}
    public function peutEtreSupprime()
    {
        return $this->dossiersEnCharge()->count() === 0;
    }

    public function requetes()
    {
        return $this->hasMany(Requete::class);
    }

}
