<?php

use App\Http\Controllers\Packages\CaptchaController;
use App\Http\Resources\JadwalCollection;
use App\Models\JadwalPraktik;
use App\Models\User;
use Illuminate\Http\Request;
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
        if($request->email==''){
            return response()->json([
                'data' => []
            ]);
        }
        $klien = User::role('klien')->where('email', 'like', $request->email . "%")->take(10)->get();
        return response()->json([
            'data' => $klien
        ]);
    });
    
    Route::get('/dokter', function(Request $request){ //Mencari Dokter
        if($request->email==''){
            return response()->json([
                'data' => []
            ]);
        }
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
    
    Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha']);
});


