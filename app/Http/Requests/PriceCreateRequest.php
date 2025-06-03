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
            'country.required'    => __('validation.required', ['attribute' => __('word.country')]),
            'min_kg.required'     => __('validation.required', ['attribute' => __('word.min_kg')]),
            'max_kg.required'     => __('validation.required', ['attribute' => __('word.max_kg')]),
            'price.required'      => __('validation.required', ['attribute' => __('word.price')]),
            'min_kg.numeric'      => __('validation.numeric', ['attribute' => __('word.min_kg')]),
            'max_kg.numeric'      => __('validation.numeric', ['attribute' => __('word.max_kg')]),
            'price.numeric'       => __('validation.numeric', ['attribute' => __('word.price')]),
            'min_kg.min'          => __('validation.min', ['attribute' => __('word.min_kg'), 'min' => 0]),
            'max_kg.min'          => __('validation.min', ['attribute' => __('word.max_kg'), 'min' => 0]),
            'max_kg.gt'           => __('validation.gt', ['attribute' => __('word.max_kg'), 'other' => __('word.min_kg')]),
            'country.exists'      => __('validation.exists', ['attribute' => __('word.country')]),
            'min_kg.max'          => __('validation.max', ['attribute' => __('word.min_kg'), 'max' => 1000000]),
            'max_kg.max'          => __('validation.max', ['attribute' => __('word.max_kg'), 'max' => 1000000]),
        ];
    }
}
