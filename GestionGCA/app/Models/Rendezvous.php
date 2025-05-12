<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rendezvous extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'avocat_id',
        'date',
        'heure',
        'statut',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function avocat()
    {
        return $this->belongsTo(User::class, 'avocat_id');
    }
}
