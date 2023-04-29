<?php

namespace App\Http\Requests;

use App\Models\JadwalPraktik;
use Illuminate\Foundation\Http\FormRequest;

class CreateJadwalPraktikRequest extends FormRequest
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
            'tanggal_masuk' => 'required|date|',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_masuk',
            'ketersediaan' => 'required',
            'keterangan' => 'nullable'
        ];
    }
}
