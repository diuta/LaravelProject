<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeDetailRequest extends FormRequest
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
            'ingredient' => 'required|max:50',
            'quantity' => 'required|integer',
            'unit' => 'required|max:20',
        ];
    }

    public function messages()
    {
        return [
            'ingredient.required' => 'ingredient is required',
            'ingredient.max' => 'ingredient max is 50 characters',
            'quantity.required' => 'quantity is required',
            'quantity.integer' => 'quantity must be a number',
            'unit.required' => 'unit is required',
            'unit.max' => 'unit max is 20 characters',
            'recipeDescription.max' => 'recipe description max is 255 characters'
        ];
    }
}
