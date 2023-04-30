<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePasienRequest extends FormRequest
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
            'nama_hewan' => 'required',
            'jenis_hewan' => 'required',
            'jenis_kelamin' => ['required', Rule::in(['jantan', 'betina'])],
            'ras' => 'required',
            'tanggal_lahir' => 'required',
            'image' => ['nullable', "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
        ];
    }
}
