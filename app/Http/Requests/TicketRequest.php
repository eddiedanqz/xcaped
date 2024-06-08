<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            //'event_id' => ['required'],
            'title' => ['string', 'required'],
            'price' => ['required'],
            'capacity' => ['required'],
            'available_from' => ['date', 'nullable', 'sometimes'],
            'available_to' => ['date', 'nullable', 'sometimes'],
        ];
    }
}
