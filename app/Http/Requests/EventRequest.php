<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'category_id' => ['required'],
            'description' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_date' => ['nullable', 'sometimes', 'date'],
            'end_time' => ['nullable', 'sometimes'],
            'venue' => ['required', 'string'],
            'address' => ['required', 'string'],
            'type' => ['required', 'string'],
            'image' => ['image', 'nullable', 'max:1999', 'sometimes'],

        ];
    }
}
