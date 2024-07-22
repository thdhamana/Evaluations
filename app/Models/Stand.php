<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "fichier",
        "domaine_id",
    ];

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public function evaluers()
    {
        return $this->hasMany(Evaluer::class);
    }
    
}
