<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluer extends Model
{
    use HasFactory;

    protected $fillable = [
        'soumetre',
        'resultat',
        'etat',
        'docs',
        'stand_id',
        'domaine_id',
        'user_id',
    ];

    public function stand()
    {
        return $this->belongsTo(Stand::class);
    }
    
    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
