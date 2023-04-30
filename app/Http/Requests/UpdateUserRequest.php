<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'full_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'confirmed', 'string', 'min:6'],
            'verification' => ['required', 'numeric'],
            'blocked' => ['required'],
            'address' => ['nullable',],
            'phone' => ['nullable', 'regex:/(^[0-9]+$)/i'],
        ];
    }
}
