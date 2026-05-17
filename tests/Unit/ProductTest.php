<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_sum_prices_by_quantities_with_single_product(): void
    {
        $product = new Product;
        $product->forceFill(['id' => 1, 'price' => 500]);
        $products = new Collection([$product]);

        // 500 * 3 = 1500
        $quantities = [1 => 3];

        $total = Product::sumPricesByQuantities($products, $quantities);

        $this->assertEquals(1500, $total);
    }

    public function test_sum_prices_by_quantities_with_multiple_products(): void
    {
        $gpu = new Product;
        $gpu->forceFill(['id' => 1, 'price' => 200]);

        $ram = new Product;
        $ram->forceFill(['id' => 2, 'price' => 300]);

        $products = new Collection([$gpu, $ram]);

        // (200*2) + (300*4) = 1600
        $quantities = [1 => 2, 2 => 4];

        $total = Product::sumPricesByQuantities($products, $quantities);

        $this->assertEquals(1600, $total);
    }

    public function test_sum_prices_by_quantities_returns_zero_for_empty_cart(): void
    {
        $total = Product::sumPricesByQuantities(new Collection, []);

        $this->assertEquals(0, $total);
    }

    public function test_product_price_is_stored_correctly(): void
    {
        $product = new Product;
        $product->setPrice(1599);

        $this->assertEquals(1599, $product->getPrice());
    }

    public function test_product_stock_is_stored_correctly(): void
    {
        $product = new Product;
        $product->setStock(10);

        $this->assertEquals(10, $product->getStock());
    }
}
