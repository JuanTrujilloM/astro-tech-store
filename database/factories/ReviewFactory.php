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
            // Rating 5
            ['description' => 'Great product! Highly recommend.', 'rating' => 5],
            ['description' => 'Excellent quality and fast shipping.', 'rating' => 5],
            ['description' => 'Absolutely love it! Best purchase this year.', 'rating' => 5],
            ['description' => 'Perfect for my setup. Would buy again.', 'rating' => 5],
            ['description' => 'Exceeded all my expectations. Flawless performance.', 'rating' => 5],
            ['description' => 'Top-notch build quality. Worth every penny.', 'rating' => 5],
            ['description' => 'Amazing product, works perfectly out of the box.', 'rating' => 5],
            ['description' => 'Best tech purchase I have made in years. Outstanding.', 'rating' => 5],
            ['description' => 'Incredible performance and sleek design. Love it.', 'rating' => 5],
            ['description' => 'Five stars without hesitation. A must-have.', 'rating' => 5],
            ['description' => 'Superb quality. I have recommended it to all my friends.', 'rating' => 5],
            ['description' => 'Everything I wanted and more. Truly impressed.', 'rating' => 5],
            ['description' => 'Premium feel and blazing fast. Could not be happier.', 'rating' => 5],
            ['description' => 'Stunning design and top performance. No regrets.', 'rating' => 5],
            ['description' => 'This product changed my workflow completely. Fantastic.', 'rating' => 5],

            // Rating 4
            ['description' => 'Good value for the price.', 'rating' => 4],
            ['description' => 'Works as advertised. No complaints so far.', 'rating' => 4],
            ['description' => 'Solid build and performs well for the price.', 'rating' => 4],
            ['description' => 'Fast delivery and exactly as described.', 'rating' => 4],
            ['description' => 'Really good product with minor cosmetic imperfections.', 'rating' => 4],
            ['description' => 'Great performance but the manual could be better.', 'rating' => 4],
            ['description' => 'Very satisfied overall. Just a bit bulky for my taste.', 'rating' => 4],
            ['description' => 'Reliable and well-made. Setup was straightforward.', 'rating' => 4],
            ['description' => 'Does exactly what it promises. Happy with the purchase.', 'rating' => 4],
            ['description' => 'Almost perfect. The software could use some updates.', 'rating' => 4],
            ['description' => 'Impressive specs for this price range. Slight fan noise though.', 'rating' => 4],
            ['description' => 'Sturdy construction and smooth operation. Recommended.', 'rating' => 4],
            ['description' => 'Good quality product. Packaging could be improved.', 'rating' => 4],
            ['description' => 'Runs quietly and stays cool. A solid buy.', 'rating' => 4],
            ['description' => 'Nice upgrade from my old one. Noticeable improvement.', 'rating' => 4],

            // Rating 3
            ['description' => 'Not what I expected, but still decent.', 'rating' => 3],
            ['description' => 'Average quality, nothing special.', 'rating' => 3],
            ['description' => 'Pretty good overall but packaging was damaged.', 'rating' => 3],
            ['description' => 'It works fine but feels a bit outdated compared to competitors.', 'rating' => 3],
            ['description' => 'Decent product but took forever to arrive.', 'rating' => 3],
            ['description' => 'Does the job but I have seen better at this price.', 'rating' => 3],
            ['description' => 'Mixed feelings. Some features are great, others are lacking.', 'rating' => 3],
            ['description' => 'Okay for basic use. Not suitable for heavy workloads.', 'rating' => 3],
            ['description' => 'The product is fine but customer support was unhelpful.', 'rating' => 3],
            ['description' => 'Neither impressed nor disappointed. It is just average.', 'rating' => 3],
            ['description' => 'Looks good but performance is mediocre.', 'rating' => 3],
            ['description' => 'Fair product. Instructions were confusing to follow.', 'rating' => 3],
            ['description' => 'Gets the job done but nothing to write home about.', 'rating' => 3],
            ['description' => 'Some features work well, others need improvement.', 'rating' => 3],
            ['description' => 'Acceptable for the price but do not expect premium quality.', 'rating' => 3],

            // Rating 2
            ['description' => 'It is okay but I expected better at this price point.', 'rating' => 2],
            ['description' => 'Poor quality materials. Feels cheap.', 'rating' => 2],
            ['description' => 'Disappointing performance. Would not recommend.', 'rating' => 2],
            ['description' => 'Overpriced for what you get. Not worth it.', 'rating' => 2],
            ['description' => 'Had connectivity issues right from the start.', 'rating' => 2],
            ['description' => 'The product looks nothing like the photos. Misleading.', 'rating' => 2],
            ['description' => 'Sluggish performance and frequent crashes.', 'rating' => 2],
            ['description' => 'Build quality is flimsy. Feels like it could break any day.', 'rating' => 2],
            ['description' => 'Battery life is way shorter than advertised.', 'rating' => 2],
            ['description' => 'Not compatible with most of my devices. Frustrating.', 'rating' => 2],
            ['description' => 'Arrived with scratches and a dent on the side.', 'rating' => 2],
            ['description' => 'Heats up too much during normal use. Concerning.', 'rating' => 2],
            ['description' => 'Below average experience. There are better options out there.', 'rating' => 2],
            ['description' => 'Setup was a nightmare and support was no help.', 'rating' => 2],
            ['description' => 'Feels outdated right out of the box. Save your money.', 'rating' => 2],

            // Rating 1
            ['description' => 'Terrible experience, do not buy.', 'rating' => 1],
            ['description' => 'Stopped working after a week. Very disappointed.', 'rating' => 1],
            ['description' => 'Complete waste of money. Broke on the first day.', 'rating' => 1],
            ['description' => 'Does not work at all. Returning immediately.', 'rating' => 1],
            ['description' => 'Worst purchase I have ever made. Avoid at all costs.', 'rating' => 1],
            ['description' => 'Dead on arrival. Absolute garbage.', 'rating' => 1],
            ['description' => 'Caught fire after two hours of use. Dangerous product.', 'rating' => 1],
            ['description' => 'Scam product. Nothing like the description.', 'rating' => 1],
            ['description' => 'Returned it the same day. Completely unusable.', 'rating' => 1],
            ['description' => 'Zero quality control. Missing parts and broken casing.', 'rating' => 1],
            ['description' => 'Regret this purchase entirely. Do not waste your money.', 'rating' => 1],
            ['description' => 'Product arrived broken and customer service ignored me.', 'rating' => 1],
            ['description' => 'Horrible build quality. Fell apart during unboxing.', 'rating' => 1],
            ['description' => 'Fake product. Not genuine at all. Total ripoff.', 'rating' => 1],
            ['description' => 'The worst tech product I have ever owned. Shameful.', 'rating' => 1],
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
