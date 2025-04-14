<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'adresse',
        'piece_identite',
        'type_service',
        'probleme',
        'documents',
        'adverse_info',
        'statut',
    ];
}
