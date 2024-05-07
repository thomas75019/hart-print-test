<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groupedProducts = Product::all()->groupBy('type');
        // I purposely created 3 orders for them to have the same product type on each
        $orders = Order::all();
        $orderIndex = 0;

        foreach ($groupedProducts as $type => $products) 
        {
            $order = $orders[$orderIndex % $orders->count()];

            foreach ($products as $product) 
            {
                OrderItem::factory()->create([
                    'product_id' => $product->id,
                    'order_id' => $order->id
                ]);

            }
            $orderIndex++;
        }
    }
}
