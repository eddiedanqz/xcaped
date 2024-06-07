<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CreateEventRequest extends FormRequest
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
            // 'slug' => ['required', 'string'],
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

    // public function messages() {
    //     return [
    //       'title.required' => 'A title is required',
    //       'category_id.required' => 'category is required',
    //       'image.max' => 'The document must not be greater than 10 megabytes',
    //     ];
    //   }

    //  protected function failedValidation(Validator $validator) {
    //     $response = new Response(
    //         [
    //           "success" => false, "message" => "File upload failed.",
    //           'errors' => $validator->errors()
    //         ],
    //         422);
    //     throw new ValidationException($validator, $response);
    //   }
}
