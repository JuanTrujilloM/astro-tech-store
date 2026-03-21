<?php

/**
 * Author: Juan Sebastián Lizcano Urrea
 * Description: Request responsible for validating the Add Cart request
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool // The authorize method is responsible for determining if the currently authenticated user can perform the action represented by the request
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array // Returns the validation rules that should apply to the request's data
    {
        return [
            'quantity' => 'required|integer|min:1',
        ];
    }
}
