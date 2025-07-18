<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hotel_name' => 'required',
            // exists:prefectures kiểm tra xem có trong bảng prefectures chưa
            'prefecture_id' => 'required|max:255|exists:prefectures',
            'image' => 'nullable'
        ];
    }
    public function attributes()
    {
        return [
            'hotel_name' => 'Tên khách sạn',
            'prefecture_id' => 'ID tỉnh thành',
            'image' => 'Hình ảnh'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':Attribute Must be filled',
        ];
    }
}
