<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'price_id',
        'description',
        'arp_no',
        'order_date',
        'total_amount',
        'total_kg',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'receipt_id');
    }

    public function prices()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }
}
