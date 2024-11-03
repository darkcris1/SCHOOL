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
        //
        $products = [
            [
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 100.00,
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 200.00,
            ],
            [
                'name' => 'Product 3',
                'description' => 'Description of Product 3',
                'price' => 300.00,
            ],
            [
                'name' => 'Product 4',
                'description' => 'Description of Product 4',
                'price' => 300.00,
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);

        };
    }
}
