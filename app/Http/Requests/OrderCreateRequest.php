<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
            'customer_hidden_id'    => 'required|exists:customers,id',
            'customer_name'         => 'required',
            'selected_price_id'     => 'required|exists:prices,id',
            'order_date'            => 'required|date',
            'sender_name'           => 'nullable|string|max:255',
            'sender_address'        => 'nullable|string|max:255',
            'description'           => 'nullable|string|max:1000',
            'arp_no'                => 'nullable|string|max:50',
            'various_kg'            => 'required|numeric',
            'various_amount'        => 'required|numeric',
            'meat_kg'               => 'nullable|numeric',
            'meat_total'            => 'nullable|numeric',
            'box_kg'               => 'nullable|numeric',
            'box_total'             => 'nullable|numeric',
            'cloth_kg'              => 'nullable|numeric',
            'cloth_total'           => 'nullable|numeric',
            'pharmacy_kg'           => 'nullable|numeric',
            'pharmacy_total'         => 'nullable|numeric',
            'book_kg'              => 'nullable|numeric',
            'book_total'            => 'nullable|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_hidden_id.required' => __('validation.required', ['attribute' => __('word.customer')]),
            'customer_hidden_id.exists'   => __('validation.exists', ['attribute' => __('word.customer')]),
            'customer_name.required'      => __('validation.required', ['attribute' => __('word.customer_name')]),
            'selected_price_id.required'  => __('validation.required', ['attribute' => __('word.selected_price')]),
            'selected_price_id.exists'    => __('validation.exists', ['attribute' => __('word.selected_price')]),
            'order_date.required'         => __('validation.required', ['attribute' => __('word.order_date')]),
            'order_date.date'             => __('validation.date', ['attribute' => __('word.order_date')]),
            'various_kg.required'         => __('validation.required', ['attribute' => __('word.various_kg')]),
            'various_amount.required'     => __('validation.required', ['attribute' => __('word.various_amount')]),
            'various_kg.numeric'          => __('validation.numeric', ['attribute' => __('word.various_kg')]),
            'various_amount.numeric'      => __('validation.numeric', ['attribute' => __('word.various_amount')]),
            'meat_kg.numeric'             => __('validation.numeric', ['attribute' => __('word.meat_kg')]),
            'meat_total.numeric'          => __('validation.numeric', ['attribute' => __('word.meat_total')]),
            'box_kg.numeric'              => __('validation.numeric', ['attribute' => __('word.box_kg')]),
            'box_total.numeric'           => __('validation.numeric', ['attribute' => __('word.box_total')]),
            'cloth_kg.numeric'           => __('validation.numeric', ['attribute' => __('word.cloth_kg')]),
            'cloth_total.numeric'        => __('validation.numeric', ['attribute' => __('word.cloth_total')]),
            'pharmacy_kg.numeric'        => __('validation.numeric', ['attribute' => __('word.pharmacy_kg')]),
            'pharmacy_total.numeric'     => __('validation.numeric', ['attribute' => __('word.pharmacy_total')]),
            'book_kg.numeric'            => __('validation.numeric', ['attribute' => __('word.book_kg')]),
            'book_total.numeric'         => __('validation.numeric', ['attribute' => __('word.book_total')]),
            'sender_name.string'         => __('validation.string', ['attribute' => __('word.sender_name')]),
            'sender_name.max'            => __('validation.max.string', ['attribute' => __('word.sender_name'), 'max' => 255]),
            'sender_address.string' => __('validation.string', ['attribute' => __('word.sender_address')]),
            'sender_address.max' => __('validation.max.string', ['attribute' => __('word.sender_address'), 'max' => 255]),
            'description.string' => __('validation.string', ['attribute' => __('word.description')]),
            'description.max' => __('validation.max.string', ['attribute' => __('word.description'), 'max' => 1000]),
            'arp_no.string' => __('validation.string', ['attribute' => __('word.arp_no')]),
            'arp_no.max' => __('validation.max.string', ['attribute' => __('word.arp_no'), 'max' => 50]),

        ];
    }
}
