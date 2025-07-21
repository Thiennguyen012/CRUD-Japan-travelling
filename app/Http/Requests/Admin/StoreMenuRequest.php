<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'dish_name' => 'required|string|max:255',
            'restaurant_id' => 'required|integer|exists:restaurants,restaurant_id',
            'price' => 'required|decimal:0,2|min:0',
            'description' => 'nullable|string',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':Attribute must be filled',
        ];
    }
}
