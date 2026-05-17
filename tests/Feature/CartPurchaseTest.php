<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartPurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_purchase_deducts_user_balance(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 200, 'stock' => 10]);

        $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 2]])
            ->post(route('cart.purchase'));

        $this->assertEquals(600, $user->fresh()->getBalance());
    }

    public function test_purchase_deducts_product_stock(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 3]])
            ->post(route('cart.purchase'));

        $this->assertEquals(7, $product->fresh()->getStock());
    }

    public function test_purchase_creates_order_with_correct_total(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 150, 'stock' => 10]);

        $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 2]])
            ->post(route('cart.purchase'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->getId(),
            'total' => 300,
            'status' => 'pending',
        ]);
    }

    public function test_purchase_clears_cart_from_session(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        $response = $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 1]])
            ->post(route('cart.purchase'));

        $response->assertSessionMissing('products');
    }

    public function test_purchase_fails_when_balance_is_insufficient(): void
    {
        $user = User::factory()->create(['balance' => 50]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        $response = $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 1]])
            ->post(route('cart.purchase'));

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('error');
        $this->assertEquals(50, $user->fresh()->getBalance());
    }

    public function test_purchase_fails_when_stock_is_insufficient(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 2]);

        $response = $this->actingAs($user)
            ->withSession(['products' => [$product->getId() => 5]])
            ->post(route('cart.purchase'));

        $response->assertRedirect(route('cart.index'));
        $response->assertSessionHas('error');
        $this->assertEquals(2, $product->fresh()->getStock());
    }

    public function test_purchase_applies_discount_before_charging(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        $this->actingAs($user)
            ->withSession([
                'products' => [$product->getId() => 2],
                'discount' => ['code' => 'SoftwareArchitecture', 'percentage' => 10],
            ])
            ->post(route('cart.purchase'));

        // total = 200, discount 10% = 20, charged = 180, balance = 1000 - 180 = 820
        $this->assertEquals(820, $user->fresh()->getBalance());
    }

    public function test_purchase_clears_discount_from_session(): void
    {
        $user = User::factory()->create(['balance' => 1000]);
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);

        $response = $this->actingAs($user)
            ->withSession([
                'products' => [$product->getId() => 1],
                'discount' => ['code' => 'SecretCode', 'percentage' => 30],
            ])
            ->post(route('cart.purchase'));

        $response->assertSessionMissing('discount');
    }
}
