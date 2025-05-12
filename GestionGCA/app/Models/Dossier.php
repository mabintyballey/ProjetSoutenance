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
        'type_affaire',
        'statut',
        'description',
        'information_adverse',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function avocat()
    {
        return $this->belongsTo(User::class, 'avocat_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
