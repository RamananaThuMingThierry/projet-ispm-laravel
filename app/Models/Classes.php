<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classes extends Model
{
    
    use HasFactory;

    protected $table = "Classes";

    protected $fillable = ["Niveau_Classes"];
    
    public function filieres(): HasMany 
    { 
        return $this->hasMany(Filieres::class); 
    }
}
