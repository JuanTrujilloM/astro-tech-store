<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Factory responsible for generating fake data for Reviews
 */

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reviews = [
            ['description' => 'Great product! Highly recommend.', 'rating' => 5],
            ['description' => 'Not what I expected, but still decent.', 'rating' => 3],
            ['description' => 'Excellent quality and fast shipping.', 'rating' => 5],
            ['description' => 'Terrible experience, do not buy.', 'rating' => 1],
            ['description' => 'Good value for the price.', 'rating' => 4],
            ['description' => 'Works as advertised. No complaints so far.', 'rating' => 4],
            ['description' => 'Average quality, nothing special.', 'rating' => 3],
            ['description' => 'Absolutely love it! Best purchase this year.', 'rating' => 5],
            ['description' => 'Stopped working after a week. Very disappointed.', 'rating' => 1],
            ['description' => 'Solid build and performs well for the price.', 'rating' => 4],
            ['description' => 'Pretty good overall but packaging was damaged.', 'rating' => 3],
            ['description' => 'Perfect for my setup. Would buy again.', 'rating' => 5],
            ['description' => 'It is okay but I expected better at this price point.', 'rating' => 2],
            ['description' => 'Fast delivery and exactly as described.', 'rating' => 4],
            ['description' => 'Poor quality materials. Feels cheap.', 'rating' => 2],
        ];

        $review = fake()->randomElement($reviews);

        return [
            'product_id' => Product::factory(),
            'user_id' => User::factory(),
            'description' => $review['description'],
            'rating' => $review['rating'],
        ];
    }
}
