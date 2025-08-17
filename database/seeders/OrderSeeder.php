<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(5)
            ->create()
            ->each(function ($order) {
                // Generar 1-3 items por orden
                $itemsCount = rand(1, 3);
                OrderItem::factory()
                    ->count($itemsCount)
                    ->create(['order_id' => $order->id]);
            });
    }
}
