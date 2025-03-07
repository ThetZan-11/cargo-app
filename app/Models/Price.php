<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_price');
    }
}
