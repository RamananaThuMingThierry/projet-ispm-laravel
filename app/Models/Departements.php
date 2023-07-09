<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departements extends Model
{
    use HasFactory;
    
    protected $table = "departement";

    protected $fillable = [
        "nomDepartement"
    ];

    public function filieres(): HasMany 
    { 
        return $this->hasMany(Filieres::class); 
    }
}
