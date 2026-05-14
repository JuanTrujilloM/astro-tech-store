<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Resource collection responsible for transforming a collection of products into a structured array format for API responses, including additional information about the products endpoint.
 */

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'additional_info' => [
                'url' => 'https://astro-tech-store.com/products',
            ],
        ];
    }
}
