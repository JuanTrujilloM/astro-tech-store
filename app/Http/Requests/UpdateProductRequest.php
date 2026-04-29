<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Request class responsible for validating the data when updating an existing product in the admin panel.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|gt:0',
            'stock' => 'required|integer|gte:0',
            'image' => 'nullable|image',
        ];
    }
}
