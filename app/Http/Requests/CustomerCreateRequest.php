<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|max:200|unique:customers,email',
            'phone'     => 'required|string|max:11',
            'phone2'    => 'string|max:11',
            'address'   => 'nullable|string|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'email.required'    => 'Email is required',
            'phone.required'    => 'Phone is required',
            'address.max'       => 'Address must be less than 200 characters',
        ];
    }
}
