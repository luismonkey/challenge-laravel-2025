<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

use Exception;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    // GET /api/orders
    public function index(): JsonResponse
    {
        try {
            $orders = $this->orderService->listOrders();
            return $this->success($orders);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    // POST /api/orders
    public function store(StoreOrderRequest $request): JsonResponse
    {
        try {
            $order = $this->orderService->createOrder($request->validated());
            return $this->success($order, 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    // GET /api/orders/{id}
    public function show(int $id): JsonResponse
    {
        try {
            $order = $this->orderService->getOrderDetail($id);
            if (!$order) return $this->error('Order not found', 404);

            return $this->success($order);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    // POST /api/orders/{id}/advance
    public function advance(int $id): JsonResponse
    {
        try {
            $order = $this->orderService->advanceOrder($id);

            if (!$order) {
                return $this->success('Order delivered and removed');
            }

            return $this->success($order);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
