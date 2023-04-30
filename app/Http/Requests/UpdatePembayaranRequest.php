<?php

namespace App\Http\Requests;

use App\Models\Pembayaran;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePembayaranRequest extends FormRequest
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
        $role = Auth::user()->getRoleNames()[0];

        if ($role == 'administrator' || $role = 'pegawai'){
            return  [
                'jumlah_transaksi' => 'nullable',
                'verifikasi' => "nullable|boolean",
            ];
        }
        
        return  [
            'tanggal_bayar' => 'required',
            'jumlah_transaksi' => 'nullable',
            'image' => ['required', "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
            'verifikasi' => "nullable|boolean",
        ];
    }
}
