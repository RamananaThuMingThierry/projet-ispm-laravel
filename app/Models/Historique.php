<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $table = "historiques";

    protected $fillable = [
        "image",
        "numero",
        "entrer",
        "sortir",
        "code_barre",
        "genre",
        "type_vehicule"
    ];

    protected $timestamps = false;
}
