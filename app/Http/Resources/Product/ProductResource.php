<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Resource responsible for transforming a product model into a structured array format for API responses, including related reviews and a URL to the product details.
 */

namespace App\Http\Resources\Product;

use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
            'url' => route('product.show', $this->id),

            // Include the first 3 reviews related to the product, if they are loaded
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')?->take(3)),
        ];
    }
}
