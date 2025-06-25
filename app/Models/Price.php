<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'country_id',
        'min_kg',
        'max_kg',
        'price_per_kg',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
