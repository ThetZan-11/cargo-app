<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Faker\Factory as Faker;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['country_name' => 'Thailand', 'country_code' => 'TH'],
            ['country_name' => 'Malaysia', 'country_code' => 'MY'],
            ['country_name' => 'Japan', 'country_code' => 'JP'],
            ['country_name' => 'South Korea', 'country_code' => 'KR'],
        ];

        foreach ($countries as $country) {
            Country::create([
                'country_name' => $country['country_name'],
                'country_code' => $country['country_code'],
                'country_flag' => 'https://flagcdn.com/w320/' . strtolower($country['country_code']) . '.png',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
