<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Price;
use App\Models\Product;
use App\Models\Receipt;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $prices = Price::all();
        $receipts = Receipt::all();

        // Create 30 orders
        for ($i = 0; $i < 30; $i++) {
            $price = $prices->random();
            $receipt = $receipts->random();
            $product = Product::all()->random();
            $total_kg = $faker->randomFloat(2, 1, 100);
            $line_total = $total_kg * $price->price_per_kg;
            Order::create([
                'receipt_id' => $receipt->id,
                'product_id' => $product->id,
                'total_kg' => $total_kg,
                'line_total' => $line_total,
                'status' => $faker->randomElement([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
