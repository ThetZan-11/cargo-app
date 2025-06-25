<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'price_id',
        'receipt_id',
        'total_kg',
        'line_total',
    ];

   public function receipts()
   {
       return $this->belongsTo(Receipt::class, 'receipt_id');
   }

    public function prices()
    {
        return $this->belongsTo(Price::class, 'price_id');
    }
}
