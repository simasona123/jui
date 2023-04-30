<?php

use App\Http\Controllers\Packages\CaptchaController;
use App\Http\Resources\JadwalCollection;
use App\Models\Booking;
use App\Models\Dokter;
use App\Models\JadwalPraktik;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('cors')->group(function(){
    Route::get('/klien', function(Request $request){ //Mencari Klien
        $klien = User::role('klien')->where('email', 'like', $request->email . "%")->take(10)->get();
        return response()->json([
            'data' => $klien
        ]);
    });
    
    Route::get('/dokter', function(Request $request){ //Mencari Dokter
        $dokter = User::role('dokter-hewan')->where('email', 'like', $request->email . "%")->take(10)->get();
        return response()->json([
            'data' => $dokter
        ]);
    });

    Route::get('/jadwal-praktik', function(Request $request){
        $date = $request->date;
        $jadwal = JadwalCollection::collection(JadwalPraktik::with('dokter')->whereDate('tanggal_masuk', $date)->get());

        if(count($jadwal) == 0) $message = "Jadwal tidak tersedia";
        else $message = '';
        
        return response()->json([
            'data' => $jadwal,
            'message' => $message,
        ]);
    });

    Route::get('/booking', function(Request $request){
        $kode_booking = $request->kode;
        $user_id = $request->id;
        $role = $request->role;
        if($role == 'administrator' || $role == 'manajer'){
            $data = Booking::select('id', 'kode_booking')->has('pembayaran', 0)->where('kode_booking', 'like', $kode_booking . '%')
                ->take(10)
                ->get();
            return response()->json([
                'data' => $data,
            ]);
        }
    });

    Route::get('/booking-rekam', function(Request $request){
        $kode_booking = $request->kode;
        $user_id = $request->id;
        $role = $request->role;
        if($role == 'administrator' || $role == 'manajer'){
            $data = Booking::with('jadwal_praktik')->select('id', 'kode_booking', 'jadwal_praktik_id')->has('rekam_medis', 0)->where('kode_booking', 'like', $kode_booking . '%')
                ->take(10)
                ->get();
            return response()->json([
                'data' => $data,
            ]);
        }
    });
    
    Route::get('/pasien', function(Request $request){
        $name = $request->name;
        if(isset($request->klien)){
            $data = Pasien::where('nama_hewan', 'like', $name . '%')->where('user_id', $request->klien)->get();
        }else{
            $data = Pasien::with('user')->where('nama_hewan', 'like', $name . '%')->take(10)->get(); 
        }
        return response()->json([
            'data' => $data,
        ]);

    });
    
    

    Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha']);
});


