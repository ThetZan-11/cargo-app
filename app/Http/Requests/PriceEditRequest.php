<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceEditRequest extends FormRequest
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
            'edit_country' => 'required|exists:countries,id',
            'edit_min_kg' => 'required|numeric|min:0',
            'edit_max_kg' => 'required|numeric|min:0',
            'edit_price' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'edit_country.required' => __('validation.required', ['attribute' => 'Country']),
            'edit_min_kg.required'  => __('validation.required', ['attribute' => 'Min Kg']),
            'edit_max_kg.required'  => __('validation.required', ['attribute' => 'Max Kg']),
            'edit_price.required'   => __('validation.required', ['attribute' => 'Price']),
            'edit_min_kg.numeric'   => __('validation.numeric', ['attribute' => 'Min Kg']),
            'edit_max_kg.numeric'   => __('validation.numeric', ['attribute' => 'Max Kg']),
            'edit_price.numeric'    => __('validation.numeric', ['attribute' => 'Price']),
            'edit_min_kg.min'       => __('validation.min', ['attribute' => 'Min Kg', 'min' => 0]),
            'edit_max_kg.min'       => __('validation.min', ['attribute' => 'Max Kg', 'min' => 0]),
            'edit_max_kg.gt'        => __('validation.gt', ['attribute' => 'Max Kg', 'other' => 'Min Kg']),
            'edit_country.exists'   => __('validation.exists', ['attribute' => 'Selected country']),
        ];
    }
}
