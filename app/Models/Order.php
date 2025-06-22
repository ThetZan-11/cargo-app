<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'price_id',
        'total_kg',
        'total_amount',
        'arp_no',
        "order_date",
        "description",
        "status",
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function prices()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }
}
