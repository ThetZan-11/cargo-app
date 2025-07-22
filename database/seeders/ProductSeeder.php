<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name_en' => 'Various',  'name_mm' => 'ပစ္စည်းအစုံ'],
            ['name_en' => 'meat',     'name_mm' => 'အသား'],
            ['name_en' => 'book',     'name_mm' => 'စာအုပ်'],
            ['name_en' => 'pharmacy', 'name_mm' => 'ဆေး'],
            ['name_en' => 'cloth',    'name_mm' => 'အဝတ်အစား'],
            ['name_en' => 'cosmetic', 'name_mm' => 'အလှကုန်'],
            ['name_en' => 'box',      'name_mm' => 'သေတ္တာ'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
