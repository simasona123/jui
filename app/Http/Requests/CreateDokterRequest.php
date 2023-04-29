<?php

namespace App\Http\Requests;

use App\Models\Dokter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDokterRequest extends FormRequest
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
            'user_id' => 'required',
            'spesialis' => 'nullable',
            'nip' => 'nullable',
            'jenis_kelamin' => ['required', Rule::in(['pria', 'perempuan'])],
            'image' => ['nullable', "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
        ];
    }
}
