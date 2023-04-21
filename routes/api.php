<?php

use App\Http\Controllers\Packages\CaptchaController;
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

Route::get('/klien', function(Request $request){
    $klien = User::role('klien')->where('email', 'like', $request->email . "%")->take(10)->get();
    return response()->json([
        'data' => $klien
    ]);
});

Route::get('/dokter', function(Request $request){
    $dokter = User::role('dokter-hewan')->where('email', 'like', $request->email . "%")->take(10)->get();
    return response()->json([
        'data' => $dokter
    ]);
});

Route::get('/reload-captcha', [CaptchaController::class, 'reloadCaptcha']);
