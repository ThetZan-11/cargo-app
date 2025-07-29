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
        // Get country IDs
        $japan = Country::where('country_name', 'Japan')->first();
        $korea = Country::where('country_name', 'Korea')->first();

        // Prices for Japan
        $japanPrices = [
            ['min_kg' => 0, 'max_kg' => 20, 'price_per_kg' => 42000],
            ['min_kg' => 15, 'max_kg' => 19, 'price_per_kg' => 47000],
            ['min_kg' => 10, 'max_kg' => 14, 'price_per_kg' => 49000],
            ['min_kg' => 6, 'max_kg' => 9,  'price_per_kg' => 55000],
        ];

        foreach ($japanPrices as $data) {
            Price::create([
                'country_id' => $japan->id,
                'min_kg' => $data['min_kg'],
                'max_kg' => $data['max_kg'],
                'price_per_kg' => $data['price_per_kg'],
                'price_type' => 'public',
            ]);
        }

        // Prices for Korea
        $koreaPrices = [
            ['min_kg' => 0, 'max_kg' => 20, 'price_per_kg' => 38000],
            ['min_kg' => 15, 'max_kg' => 19, 'price_per_kg' => 42000],
            ['min_kg' => 10, 'max_kg' => 14, 'price_per_kg' => 45000],
            ['min_kg' => 6, 'max_kg' => 9,  'price_per_kg' => 52000],
        ];

        foreach ($koreaPrices as $data) {
            Price::create([
                'country_id' => $korea->id,
                'min_kg' => $data['min_kg'],
                'max_kg' => $data['max_kg'],
                'price_per_kg' => $data['price_per_kg'],
                'price_type' => 'public',
            ]);
        }

        // Prices for Korea Agent
        $koreaPricesAgent = [
            ['min_kg' => 0, 'max_kg' => 20, 'price_per_kg' => 37000],
            ['min_kg' => 18, 'max_kg' => 19, 'price_per_kg' => 38000],
            ['min_kg' => 15, 'max_kg' => 17, 'price_per_kg' => 40000],
            ['min_kg' => 0, 'max_kg' => 14, 'price_per_kg' => 41000],
            ['min_kg' => 0, 'max_kg' => 13, 'price_per_kg' => 42000],
            ['min_kg' => 10, 'max_kg' => 12, 'price_per_kg' => 43000],
            ['min_kg' => 8, 'max_kg' => 9, 'price_per_kg' => 48000],
            ['min_kg' => 6, 'max_kg' => 7,  'price_per_kg' => 51000],
        ];

        foreach ($koreaPricesAgent as $data) {
            Price::create([
                'country_id' => $korea->id,
                'min_kg' => $data['min_kg'],
                'max_kg' => $data['max_kg'],
                'price_per_kg' => $data['price_per_kg'],
                'price_type' => 'agent',
            ]);
        }

        $japanPricesAgent = [
            ['min_kg' => 0, 'max_kg' => 20, 'price_per_kg' => 41000],
            ['min_kg' => 15, 'max_kg' => 19, 'price_per_kg' => 42000],
            ['min_kg' => 10, 'max_kg' => 14, 'price_per_kg' => 45000],
            ['min_kg' => 8, 'max_kg' => 9, 'price_per_kg' => 50000],
            ['min_kg' => 6, 'max_kg' => 7,  'price_per_kg' => 52000],
        ];

        foreach ($japanPricesAgent as $data) {
            Price::create([
                'country_id' => $japan->id,
                'min_kg' => $data['min_kg'],
                'max_kg' => $data['max_kg'],
                'price_per_kg' => $data['price_per_kg'],
                'price_type' => 'agent',
            ]);
        }
    }
}
