<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => ['required','max:255'],

            'type' => ['required'],

            'phone' => ['nullable','max:30'],

            'email' => ['nullable','email'],

            'address' => ['nullable'],

            'notes' => ['nullable'],

        ];
    }
}