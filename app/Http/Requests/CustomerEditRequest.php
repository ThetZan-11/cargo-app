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
            'edit_phone2'    => 'string|max:11',
            'edit_address'   => 'required|string|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'edit_name.required'     => 'Name is required',
            'edit_name.max'          => 'Name must be less than 100 characters',
            'edit_phone.required'    => 'Phone is required',
            'edit_phone.max'         => 'Phone must be less than 11 characters',
            'edit_phone2.max'        => 'Phone 2 must be less than 11 characters',
            'edit_email.email'       => 'Email must be a valid email address',
            'edit_email.max'         => 'Email must be less than 200 characters',
            'edit_address.max'       => 'Address must be less than 200 characters',
        ];
    }
}
