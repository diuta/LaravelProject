<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
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
            'dishName' => 'required|string|max:100',
            'dishType' => 'required|string|max:100',
            'dishPrice' => 'required|integer',
        ];
    }

    public function messages() {
        return [
            'dishName.max' => 'Dish Name Max is 100 characters',
            'dishType.max' => 'Dish Type Max is 100 characters',
            'dishPrice.integer' => 'Please input the dish price in numbers',
        ];
    }
}
