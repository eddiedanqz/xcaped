<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentDetailRequest extends FormRequest
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
            'payment_details.payment_method' => ['required', 'string'],
            'payment_details.phone_number' => ['nullable', 'sometimes', 'string'],
            'payment_details.account_number' => ['nullable', 'sometimes', 'string'],
            'payment_details.bank_name' => ['nullable', 'sometimes', 'string'],
        ];
    }
}
