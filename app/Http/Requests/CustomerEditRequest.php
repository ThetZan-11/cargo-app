<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerEditRequest extends FormRequest
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
            'edit_name'      => 'required|string|max:100',
            'edit_email'     => 'nullable|email|max:200',
            'edit_phone'     => 'required|string|max:11',
            'edit_phone2'    => 'nullable|max:15',
            'edit_address'   => 'required|string|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     =>  __('validation.required', ['attribute' => __('word.customer_name')]),
            'name.max'          =>  __('validation.max', ['attribute' => __('word.customer_name'), 'max' => 100]),
            'phone.required'    =>  __('validation.required', ['attribute' => __('word.customer_phone')]),
            'phone.max'         =>  __('validation.max', ['attribute' => __('word.customer_phone'), 'max' => 11]),
            'phone2.max'        =>  __('validation.max', ['attribute' => __('word.customer_phone2'), 'max' => 11]),
            'email.email'       =>  __('validation.email', ['attribute' => __('word.customer_email')]),
            'email.max'         =>  __('validation.max', ['attribute' => __('word.customer_email'), 'max' => 200]),
            'email.unique'      =>  __('validation.unique', ['attribute' => __('word.customer_email')]),
            'address.max'       =>  __('validation.max', ['attribute' => __('word.customer_address'), 'max' => 200]),
            'address.required'  =>  __('validation.required', ['attribute' => __('word.customer_address')]),
        ];
    }
}
