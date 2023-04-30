<?php

namespace App\Http\Requests;

use App\Models\RekamMedis;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRekamMedisRequest extends FormRequest
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
            'booking_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            // 'nomor_rekam_medis' => 'required', //Generate Otomatis
            'keluhan' => 'required',
            'diagnosis' => 'required',
            'prognosa' => 'required',
            'tindakan' => 'required',
            'suhu' => 'required|numeric',
            'berat' => 'required|numeric',
            'tgl_pemeriksaan' => 'required|date',
            'keterangan' => 'required'
        ];
    }
}
