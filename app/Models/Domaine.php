<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom","description"
    ];

    public function stands()
    {
        return $this->hasMany(Stand::class);
    }

    public function evaluers()
    {
        return $this->hasMany(Evaluer::class);
    }
}
