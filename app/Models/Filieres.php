<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filieres extends Model
{
    use HasFactory;

    protected $table = "Filiers";

    protected $fillable = [
        "Nom_Filieres",
        "Sigle_Filieres",
        "Classes_id"
    ];

    public function etudiants(): HasMany 
    { 
        return $this->hasMany(Etudiants::class); 
    }

    public function classes(): BelongsTo 
    { 
        return $this->belongsTo(Classes::class); 
    }
}
