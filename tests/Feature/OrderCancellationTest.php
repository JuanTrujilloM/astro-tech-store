<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCancellationTest extends TestCase
{
    use RefreshDatabase;

    public function test_cancel_order_sets_status_to_cancelled(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->getId(),
            'status' => 'pending',
            'can_be_cancelled' => true,
        ]);

        $this->actingAs($user)->post(route('order.cancel', $order->getId()));

        $this->assertEquals('cancelled', $order->fresh()->getStatus());
    }

    public function test_cancel_order_restores_product_stock(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['stock' => 5]);
        $order = Order::factory()->create([
            'user_id' => $user->getId(),
            'status' => 'pending',
            'can_be_cancelled' => true,
        ]);
        Item::factory()->create([
            'order_id' => $order->getId(),
            'product_id' => $product->getId(),
            'quantity' => 3,
        ]);

        $this->actingAs($user)->post(route('order.cancel', $order->getId()));

        $this->assertEquals(8, $product->fresh()->getStock());
    }

    public function test_order_with_cannot_be_cancelled_flag_keeps_original_status(): void
    {
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->getId(),
            'status' => 'completed',
            'can_be_cancelled' => false,
        ]);

        $this->actingAs($user)->post(route('order.cancel', $order->getId()));

        $this->assertEquals('completed', $order->fresh()->getStatus());
    }

    public function test_user_cannot_cancel_another_users_order(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $owner->getId(),
            'status' => 'pending',
            'can_be_cancelled' => true,
        ]);

        $response = $this->actingAs($other)->post(route('order.cancel', $order->getId()));

        $response->assertNotFound();
        $this->assertEquals('pending', $order->fresh()->getStatus());
    }
}
