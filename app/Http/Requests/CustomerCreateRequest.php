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
            'email'     => 'nullable|email|max:200',
            'phone'     => 'required|string|max:11',
            'phone2'    => 'string|max:11',
            'address'   => 'required|string|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Name is required',
            'name.max'          => 'Name must be less than 100 characters',
            'phone.required'    => 'Phone is required',
            'phone.max'         => 'Phone must be less than 11 characters',
            'phone2.max'        => 'Phone 2 must be less than 11 characters',
            'email.email'       => 'Email must be a valid email address',
            'email.max'         => 'Email must be less than 200 characters',
            'email.unique'      => 'Email already exists',
            'address.max'       => 'Address must be less than 200 characters',
        ];
    }
}
