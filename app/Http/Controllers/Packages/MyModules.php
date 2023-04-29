<?php

namespace App\Http\Controllers\Packages;

use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Flash;


class MyModules 
{
    public static function cek_pasien_pertama($user, $role)
    {
        if(!$role != 'klien'){
            return 1;
        }
        $pasien = Pasien::where('user_id', $user->id)->get();
        if(count($pasien) == 0){
            Flash::success('Silahkan daftarkan hewan peliharaan terlebih dahulu');
            return -1;
        }
    }
}
