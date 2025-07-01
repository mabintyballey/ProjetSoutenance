<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialite extends Model
{
    use HasFactory;
     protected $fillable = ['domaine_id', 'nom'];

    public function domaine()
    {
       return $this->belongsTo(Domaine::class);
    }

   public function avocats()
   {
       return $this->hasMany(Avocat::class);
   }

}
