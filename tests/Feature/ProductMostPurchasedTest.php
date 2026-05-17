<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductMostPurchasedTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_most_purchased_excludes_cancelled_orders(): void
    {
        $user = User::factory()->create();
        $productA = Product::factory()->create();
        $productB = Product::factory()->create();

        $cancelledOrder = Order::factory()->create(['user_id' => $user->getId(), 'status' => 'cancelled', 'can_be_cancelled' => false]);
        Item::factory()->create(['order_id' => $cancelledOrder->getId(), 'product_id' => $productA->getId(), 'quantity' => 10]);

        $completedOrder = Order::factory()->create(['user_id' => $user->getId(), 'status' => 'completed', 'can_be_cancelled' => false]);
        Item::factory()->create(['order_id' => $completedOrder->getId(), 'product_id' => $productB->getId(), 'quantity' => 3]);

        $mostPurchased = Product::getMostPurchased(1);

        $this->assertEquals($productB->getId(), $mostPurchased->first()->getId());
    }

    public function test_get_most_purchased_returns_correct_limit(): void
    {
        Product::factory()->count(5)->create();

        $result = Product::getMostPurchased(3);

        $this->assertCount(3, $result);
    }

    public function test_get_most_purchased_orders_by_quantity_descending(): void
    {
        $user = User::factory()->create();
        $topProduct = Product::factory()->create();
        $lowProduct = Product::factory()->create();

        $order = Order::factory()->create(['user_id' => $user->getId(), 'status' => 'completed', 'can_be_cancelled' => false]);
        Item::factory()->create(['order_id' => $order->getId(), 'product_id' => $topProduct->getId(), 'quantity' => 50]);
        Item::factory()->create(['order_id' => $order->getId(), 'product_id' => $lowProduct->getId(), 'quantity' => 1]);

        $result = Product::getMostPurchased(2);

        $this->assertEquals($topProduct->getId(), $result->first()->getId());
    }
}
