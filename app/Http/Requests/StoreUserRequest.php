<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Form request for validating user data when creating or updating users in the admin panel, ensuring that the input meets the required criteria for name, email, password, balance, and role.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'balance' => 'nullable|integer|gte:0',
            'role' => 'required|string|in:admin,client',
        ];
    }
}
