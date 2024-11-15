<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'price' => 100.00,
                'description' => 'Description for Product 1',
            ],
            [
                'name' => 'Product 2',
                'price' => 200.00,
                'description' => 'Description for Product 2',
            ],
            [
                'name' => 'Product 3',
                'price' => 300.00,
                'description' => 'Description for Product 3',
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
