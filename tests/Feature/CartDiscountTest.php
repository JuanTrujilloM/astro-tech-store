<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartDiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_discount_code_stores_discount_in_session(): void
    {
        $response = $this->post(route('cart.applyDiscount'), [
            'discount_code' => 'SoftwareArchitecture',
        ]);

        $response->assertSessionHas('discount', [
            'code' => 'SoftwareArchitecture',
            'percentage' => 10,
        ]);
    }

    public function test_discount_code_is_case_insensitive(): void
    {
        $response = $this->post(route('cart.applyDiscount'), [
            'discount_code' => 'softwarearchitecture',
        ]);

        $response->assertSessionHas('discount.percentage', 10);
    }

    public function test_invalid_discount_code_is_rejected(): void
    {
        $response = $this->post(route('cart.applyDiscount'), [
            'discount_code' => 'INVALID_CODE',
        ]);

        $response->assertSessionMissing('discount');
        $response->assertSessionHas('error');
    }

    public function test_secret_code_gives_100_percent_discount(): void
    {
        $response = $this->post(route('cart.applyDiscount'), [
            'discount_code' => 'QueCochinadaDeCodigo',
        ]);

        $response->assertSessionHas('discount.percentage', 100);
    }

    public function test_remove_discount_clears_discount_from_session(): void
    {
        $response = $this->withSession([
            'discount' => ['code' => 'SecretCode', 'percentage' => 30],
        ])->post(route('cart.removeDiscount'));

        $response->assertSessionMissing('discount');
    }
}
