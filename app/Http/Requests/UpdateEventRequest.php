<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'category_id' => ['required'],
            'description' => ['required', 'string'],
            'start_date' => ['required'],
            'start_time' => ['required'],
            'end_date' => ['nullable'],
            'end_time' => ['nullable'],
            'venue' => ['required', 'string'],
            'address' => ['required', 'string'],
            'type' => ['required', 'string'],
            'image' => ['image', 'nullable', 'max:1999'],
        ];
    }
}
