<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potion extends Model
{
    use HasFactory;
    
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class,'ingredient_potion')->withPivot('amount')->withTimestamps();
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class,'sale_details')->withTimestamps();
    }
    
}
