<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filieres extends Model
{
    use HasFactory;

    protected $table = "Filieres";

    protected $fillable = [
        "nomFilieres",
        "sigleFilieres",
        "Departement_id"
    ];

    public function etudiants(): HasMany 
    { 
        return $this->hasMany(Etudiants::class); 
    }

    public function departements(): BelongsTo 
    { 
        return $this->belongsTo(Departements::class); 
    }
}
