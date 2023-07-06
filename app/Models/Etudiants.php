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
        "Nom_Eudiants",
        "Prenom_Etudiants",
        "Ddn_Etudiants",
        "Ldn_Etudiants",
        "Sexe",
        "Contact_Etudiants",
        "Email_Etudiants",
        "Adresse_Etudiants",
        "Image_Etudiants",
        "Documents",
        "code_barre",
        "NumMatriculeMoto",
        "Filieres_id"
    ];

    public function filieres(): BelongsTo 
    { 
        return $this->belongsTo(Filieres::class); 
    }
}
