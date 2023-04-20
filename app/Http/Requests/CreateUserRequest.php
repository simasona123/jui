<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
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
            'full_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'string', 'size:8'],
            'role' => ['required', 'numeric'],
            'verification' => ['required', 'numeric'],
            'address' => ['nullable',],
            'phone' => ['nullable', 'regex:/(^[0-9]+$)/i'],
        ];
       
    }
}
