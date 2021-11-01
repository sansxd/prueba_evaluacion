<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function potions()
    {
        return $this->belongsToMany(Potion::class,'sale_details')->withPivot('amount','sub_total')->withTimestamps();
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
