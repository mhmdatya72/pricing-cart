<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            ['name' => 'T-shirt', 'price' => 30.99, 'weight' => 0.2, 'country' => 'US', 'shipping_rate' => 2],
            ['name' => 'Blouse', 'price' => 10.99, 'weight' => 0.3, 'country' => 'UK', 'shipping_rate' => 3],
            ['name' => 'Pants', 'price' => 64.99, 'weight' => 0.9, 'country' => 'UK', 'shipping_rate' => 3],
            ['name' => 'Sweatpants', 'price' => 84.99, 'weight' => 1.1, 'country' => 'CN', 'shipping_rate' => 2],
            ['name' => 'Jacket', 'price' => 199.99, 'weight' => 2.2, 'country' => 'US', 'shipping_rate' => 2],
            ['name' => 'Shoes', 'price' => 79.99, 'weight' => 1.3, 'country' => 'CN', 'shipping_rate' => 2],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}