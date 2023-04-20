<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::prefix('/admin/users')->name('users.')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/', 'index')->name('index')->middleware(['role:administrator|manajer']);
            Route::get('/create', "create")->name("create")->middleware(['role:administrator|manajer']);
            Route::post('/', "store")->name("store")->middleware(['role:administrator|manajer']);
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit")->middleware(['role:administrator|manajer']);
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy")->middleware(['role:administrator|manajer']);
            Route::get('/edit/profil', "profil")->name('profil');
            Route::put('/edit/profil', "profil_update")->name('profil_update');
        });
    });
});

// Route::resource('users',  App\Http\Controllers\UserController::class);

Auth::routes();


Route::resource('pasien', App\Http\Controllers\PasienController::class);
Route::resource('dokter', App\Http\Controllers\DokterController::class);