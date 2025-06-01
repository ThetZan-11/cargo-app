<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceCreateRequest extends FormRequest
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
            'country'   => 'required|exists:countries,id',
            'min_kg'    => 'required|numeric|min:0',
            'max_kg'    => 'required|numeric|min:0|gt:min_kg',
            'price'     => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'country.required'    => __('validation.required', ['attribute' => 'Country']),
            'min_kg.required'     => __('validation.required', ['attribute' => 'Min Kg']),
            'max_kg.required'     => __('validation.required', ['attribute' => 'Max Kg']),
            'price.required'      => __('validation.required', ['attribute' => 'Price']),
            'min_kg.numeric'      => __('validation.numeric', ['attribute' => 'Min Kg']),
            'max_kg.numeric'      => __('validation.numeric', ['attribute' => 'Max Kg']),
            'price.numeric'       => __('validation.numeric', ['attribute' => 'Price']),
            'min_kg.min'          => __('validation.min', ['attribute' => 'Min Kg', 'min' => 0]),
            'max_kg.min'          => __('validation.min', ['attribute' => 'Max Kg', 'min' => 0]),
            'max_kg.gt'           => __('validation.gt', ['attribute' => 'Max Kg', 'other' => 'Min Kg']),
            'country.exists'      => __('validation.exists', ['attribute' => 'Selected country']),
            'min_kg.max'          => __('validation.max', ['attribute' => 'Min Kg', 'max' => 1000000]),
            'max_kg.max'          => __('validation.max', ['attribute' => 'Max Kg', 'max' => 1000000]),
        ];
    }
}
