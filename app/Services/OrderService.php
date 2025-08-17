<?php

namespace App\Services;

use App\Repositories\OrderRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OrderService
{
    protected $orderRepo;
    protected $cacheTTL = 30; // segundos

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    // Listar órdenes activas con cache
    public function listOrders()
    {
        return Cache::remember('orders_active', $this->cacheTTL, function () {
            return $this->orderRepo->allActive();
        });
    }

    // Crear orden
    public function createOrder(array $data)
    {
        $order = $this->orderRepo->create($data);

        // Limpiar cache
        Cache::forget('orders_active');

        return $order;
    }

    // Avanzar estado de orden
    public function advanceOrder(int $id)
    {
        $order = $this->orderRepo->find($id);
        if (!$order) return null;

        $prevStatus = $order->status;
        $order = $this->orderRepo->advanceStatus($id);

        // Log del cambio de estado
        Log::info("Order #{$id} status changed: {$prevStatus} -> {$order->status}");

        // Si llegó a delivered, eliminar y limpiar cache
        if ($order->status === 'delivered') {
            $this->orderRepo->delete($id);
            Cache::forget('orders_active');
            return null;
        }

        // Limpiar cache de listado
        Cache::forget('orders_active');

        return $order;
    }

    // Detalle de orden
    public function getOrderDetail(int $id)
    {
        return $this->orderRepo->find($id);
    }
}
