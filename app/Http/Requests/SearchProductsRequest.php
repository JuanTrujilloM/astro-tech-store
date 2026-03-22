<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_search' => ['nullable', 'string', 'max:100'],
            'price_min' => ['nullable', 'integer', 'min:0'],
            'price_max' => ['nullable', 'integer', 'min:0'],
            'min_rating' => ['nullable', 'integer', 'min:1', 'max:5'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'product_search' => __('messages.product.search_query_attribute'),
            'price_min' => __('messages.product.filter_price_min_attribute'),
            'price_max' => __('messages.product.filter_price_max_attribute'),
            'min_rating' => __('messages.product.filter_min_rating_attribute'),
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            if ($this->filled('price_min') && $this->filled('price_max') && (int) $this->input('price_min') > (int) $this->input('price_max')) {
                $validator->errors()->add(
                    'price_max',
                    __('messages.product.filter_price_invalid_range')
                );
            }
        });
    }
}
