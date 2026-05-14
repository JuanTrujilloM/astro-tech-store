<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Resource responsible for transforming a review model into a structured array format for API responses.
 */


namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'description' => $this->description,
            'rating' => $this->rating,
        ];
    }
}
