<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PayRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $providers = array_keys(config('payments.providers'));

        return [
            'amount'   => ['required', 'numeric', 'min:1'],
            'provider' => ['nullable', Rule::in($providers)],
            'country'  => ['nullable', 'string', 'size:2'],
        ];
    }
}
