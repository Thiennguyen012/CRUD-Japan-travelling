<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreHotelRequest extends FormRequest
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
            'hotel_name' => 'required|string|max:255',
            'prefecture_id' => 'required|integer|exists:prefectures,prefecture_id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'hotel_name' => 'ホテル名',
            'prefecture_id' => '都道府県',
            'image' => 'イメージ画像',
        ];
    }
    public function messages()
    {
        return ['required' => ':attribute Must be filled'];
    }
}
