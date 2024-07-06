<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Random\Engine\Secure;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom","abreger","service_id"
    ];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
