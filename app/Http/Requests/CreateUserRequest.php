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
            'password' => ['required', 'confirmed', 'string', 'min:6', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/'],
            'role' => ['required', 'numeric'],
            'verification' => ['required', 'numeric'],
            'address' => ['required',],
            'phone' => ['required', 'regex:/(^[0-9]+$)/i', 'min:10'],
            'blocked' => ['required']
        ];  
    }

    public function messages(){
        return [
            'password' => 'Kata sandi harus terdiri satu huruf kapital, satu angka, dan minimal 6 karakter',
            'role' => 'Silahkan pilih role',
            'verification' => 'Silahkan pilih verifikasi',
        ];
    }
}
