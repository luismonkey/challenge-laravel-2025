<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function allActive()
    {
        return Order::with('items')
                    ->where('status', '!=', 'delivered')
                    ->get();
    }

    public function find(int $id): ?Order
    {
        return Order::with('items')->find($id);
    }

    public function create(array $data): Order
    {
        return DB::transaction(function () use ($data) {
            $order = Order::create([
                'client_name' => $data['client_name'],
                'status' => 'initiated',
            ]);

            foreach ($data['items'] as $item) {
                $order->items()->create($item);
            }

            return $order;
        });
    }

    public function advanceStatus(int $id): ?Order
    {
        $order = Order::find($id);
        if (!$order) return null;

        if ($order->status === 'initiated') $order->status = 'sent';
        elseif ($order->status === 'sent') $order->status = 'delivered';

        $order->save();

        return $order;
    }

    public function delete(int $id): void
    {
        Order::destroy($id);
    }
}
