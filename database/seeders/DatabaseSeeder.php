<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Seeder responsible for populating the database with initial data for Users, Products, Orders, Items, and Reviews
 */

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@astrotech.com',
            'role' => 'admin',
            'balance' => 9999,
        ]);

        $products = Product::factory(20)->create();

        foreach ($products as $product) {
            $reviewers = $users->random(5);
            foreach ($reviewers as $reviewer) {
                Review::factory()->create([
                    'product_id' => $product->getId(),
                    'user_id' => $reviewer->getId(),
                ]);
            }
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $order = Order::factory()->create([
                    'user_id' => $user->getId(),
                ]);

                $orderProducts = $products->random(rand(1, 3));
                $total = 0;

                foreach ($orderProducts as $product) {
                    $quantity = rand(1, 3);
                    Item::factory()->create([
                        'order_id' => $order->getId(),
                        'product_id' => $product->getId(),
                        'quantity' => $quantity,
                        'price' => $product->getPrice(),
                    ]);
                    $total += $product->getPrice() * $quantity;
                }

                $order->setTotal($total);
                $order->save();
            }
        }
    }
}
