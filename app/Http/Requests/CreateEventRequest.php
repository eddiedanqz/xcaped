<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

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
            'title' => ['required'],
            'category_id' => ['required'],
            'description' => ['nullable'],
            'image' => ['image','nullable','max:1999'],
            'start_date' => ['required'],
            'start_time' => ['required'],
            'end_date' => ['nullable'],
            'end_time' => ['nullable'],
            'venue' => ['required'],

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
