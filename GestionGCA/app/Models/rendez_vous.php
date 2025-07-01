<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rendez_vous extends Model
{
    use HasFactory;

    protected $casts = [
        'date_heure' => 'datetime',
    ];

    protected $fillable = [
        'dossier_id',  
        'date_heure',
        'lieu',
        'motif',
    ];

    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}

