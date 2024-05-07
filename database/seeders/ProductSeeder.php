<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsData = [
            ['name' => 'Product A', 'type' => config('product-types.type-1.slug')],
            ['name' => 'Product B', 'type' => config('product-types.type-1.slug')],
            ['name' => 'Product C', 'type' => config('product-types.type-2.slug')],
            ['name' => 'Product D', 'type' => config('product-types.type-3.slug')],
            ['name' => 'Product E', 'type' => config('product-types.type-3.slug')],
            ['name' => 'Product F', 'type' => config('product-types.type-1.slug')],
        ];

        Product::factory()->createMany($productsData);
    }    
}
