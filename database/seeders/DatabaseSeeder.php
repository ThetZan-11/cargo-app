<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            PriceSeeder::class,
            ReceiptSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
