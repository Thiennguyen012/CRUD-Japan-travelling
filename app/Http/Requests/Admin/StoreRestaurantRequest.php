<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
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
            'restaurant_name' => 'required|max:255|string',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'prefecture_id' => 'required|integer|exists:prefectures,prefecture_id',
            'contact' => 'required|string|max:255',
            'price' => 'required|decimal:0,2|min:0',
        ];
    }
    public function attributes()
    {
        return [
            'restaurant_name' => 'Name of the Restaurant',
            'description' => 'Describe the Restaurant features',
            'address' => 'Restaurant location',
            'prefecture_id' => 'Prefecture ID',
            'contact' => 'Contact Information', // Thêm contact attribute
            'price' => 'Price',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':Attribute Must be filled'
        ];
    }
}
