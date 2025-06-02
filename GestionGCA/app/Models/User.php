<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
 protected $fillable = [
    'name',
    'prenom',
    'email',
    'password',
    'role',
    'specialite',
    'telephone',
    'adresse',
    'photo',
    'statut_validation',
];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    use Notifiable;
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
   
    // Pour un avocat
public function dossiersEnCharge()
{
    return $this->hasMany(Dossier::class, 'avocat_id');
}

// Pour un client
public function dossiersSoumis()
{
    return $this->hasMany(Dossier::class, 'client_id');
}

    // Relations avec les rendez-vous
    public function rendezVousCommeClient()
    {
        return $this->hasMany(RendezVous::class, 'client_id');
    }

    public function rendezVousCommeAvocat()
    {
        return $this->hasMany(RendezVous::class, 'avocat_id');
    }
}
