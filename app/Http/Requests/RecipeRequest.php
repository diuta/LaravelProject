<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
            'recipeName' => 'required|max:100',
        ];
    }

    public function messages()
    {
        return [
            'recipeName.required' => 'Recipe name is required',
            'recipeName.max' => 'Recipe name max is 100 character',
        ];
    }
}
