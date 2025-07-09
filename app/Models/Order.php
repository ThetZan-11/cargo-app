<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'receipt_id',
        'total_kg',
        'line_total',
        'status',
    ];

    public function receipts()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
