<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'description',
        'arp_no',
        'order_date',
        'total_amount',
    ];

     public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'receipt_id');
    }
}
