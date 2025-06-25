<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receipt;
use App\Models\Customer;
use Faker\Factory as Faker;

class ReceiptSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $customers = Customer::all();

        // Create 20 receipts
        for ($i = 0; $i < 20; $i++) {
            $customer = $customers->random();
            Receipt::create([
                'customer_id' => $customer->id,
                'description' => $faker->sentence,
                'arp_no' => $faker->unique()->numerify('ARP####'),
                'order_date' => $faker->date(),
                'total_amount' => $faker->randomFloat(2, 100, 10000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 