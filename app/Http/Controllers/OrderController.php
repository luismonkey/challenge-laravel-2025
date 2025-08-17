<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

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
        $orders = $this->orderService->listOrders();
        return response()->json($orders);
    }

    // POST /api/orders
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $order = $this->orderService->createOrder($request->validated());
        return response()->json($order, 201);
    }

    // GET /api/orders/{id}
    public function show(int $id): JsonResponse
    {
        $order = $this->orderService->getOrderDetail($id);
        if (!$order) return response()->json(['message' => 'Order not found'], 404);

        return response()->json($order);
    }

    // POST /api/orders/{id}/advance
    public function advance(int $id): JsonResponse
    {
        $order = $this->orderService->advanceOrder($id);

        if (!$order) {
            return response()->json(['message' => 'Order delivered and removed'], 200);
        }

        return response()->json($order);
    }
}
