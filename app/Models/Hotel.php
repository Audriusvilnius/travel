<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    public function hotel_Country()
    {
        return $this->hasMany(Country::class, 'hotel_id', 'id');
    }
    
}