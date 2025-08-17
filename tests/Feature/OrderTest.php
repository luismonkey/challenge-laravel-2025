<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_new_order_with_items()
    {
        $payload = [
            'client_name' => 'Carlos Gómez',
            'items' => [
                ['description' => 'Lomo saltado', 'quantity' => 1, 'unit_price' => 60],
                ['description' => 'Inka Kola', 'quantity' => 2, 'unit_price' => 10],
            ]
        ];

        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'client_name' => 'Carlos Gómez',
                     'status' => 'initiated'
                 ]);

        $this->assertDatabaseHas('orders', [
            'client_name' => 'Carlos Gómez',
            'status' => 'initiated'
        ]);

        $this->assertDatabaseHas('order_items', [
            'description' => 'Lomo saltado',
            'quantity' => 1,
            'unit_price' => 60
        ]);
    }
}
