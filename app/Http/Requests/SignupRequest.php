<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'base' => ['array','required'],
            'base.username' => ['string','required','unique:users,username'],
            'base.fullname' => ['nullable','string'],
            'base.email' => ['required','email','unique:users,email'],
            'base.password' => ['confirmed','string','min:8'],
            'login' => ['required','boolean']
        ];
    }
}
