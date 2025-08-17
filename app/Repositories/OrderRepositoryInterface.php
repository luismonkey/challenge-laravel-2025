<?php

namespace App\Repositories;

use App\Models\Order;

interface OrderRepositoryInterface
{
    public function allActive();
    public function find(int $id): ?Order;
    public function create(array $data): Order;
    public function advanceStatus(int $id): ?Order;
    public function delete(int $id): void;
}
