<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;
use App\Models\Country;
use Faker\Factory as Faker;

class PriceSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $countries = Country::all();

        // Create 20 price records
        for ($i = 0; $i < 20; $i++) {
            $country = $countries->random();
            
            Price::create([
                'country_id' => $country->id,
                'min_kg' => $faker->randomFloat(2, 0.1, 10),
                'max_kg' => $faker->randomFloat(2, 10.1, 100),
                'price_per_kg' => $faker->randomFloat(2, 5, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 