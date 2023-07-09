<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Etudiants extends Model
{
    use HasFactory;

    protected $table = "Etudiants";

    protected $fillable = [
        "nomEudiants",
        "prenomEtudiants",
        "ddnEtudiants",
        "ldnEtudiants",
        "sexe",
        "contactEtudiants",
        "emailEtudiants",
        "adresseEtudiants",
        "imageEtudiants",
        "documents",
        "codeBarre",
        "numMatriculeMoto",
        "Filieres_id",
        "Classes_id"
    ];

    public function filieres(): BelongsTo 
    { 
        return $this->belongsTo(Filieres::class); 
    }

    public function classes(): BelongsTo 
    { 
        return $this->belongsTo(Classes::class); 
    }
}
