<?php

namespace App\Api\V1\Validators\User;

use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })
            ]
        ];
    }
}
