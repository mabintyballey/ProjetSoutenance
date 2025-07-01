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
    'nom',
    'prenom',
    'email',
    'password',
    'role',
    'telephone',
    'adresse',
    'photo',
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
   
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function avocat()
    {
        return $this->hasOne(Avocat::class);
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
    public function requetesClient()
    {
        return $this->hasMany(Requete::class, 'client_id');
    }
    
    public function requetesAvocat()
    {
        return $this->hasMany(Requete::class, 'avocat_id');
    }
    public function messagesEnvoyes() {
    return $this->hasMany(Message::class, 'expediteur_id');
    }

    public function messagesRecus() {
        return $this->hasMany(Message::class, 'destinataire_id');
    }
  
   public function allConversations()
    {
        return Conversation::where('user1_id', $this->id)
            ->orWhere('user2_id', $this->id);
    }
    public function getOtherUserAttribute()
    {
        return auth()->id() === $this->user1_id ? $this->user2 : $this->user1;
    }


}
