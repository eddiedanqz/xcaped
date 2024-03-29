<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:6'],
            'oldPassword' => ['required', function ($attribute, $value, $fail) {
                if (! Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The old password is incorrect.'));
                }
            }],

        ];
    }
}
