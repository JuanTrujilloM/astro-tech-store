<?php

/**
 * Author: Juan Esteban Trujillo Montes
 * Description: Request class responsible for validating the data when updating an existing user in the admin panel.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|email|max:255|unique:users,email,'.$this->route('user'),
            'password' => 'nullable|string|min:8',
            'balance' => 'nullable|integer|gte:0',
            'role' => 'required|string|in:admin,client',
        ];
    }
}
