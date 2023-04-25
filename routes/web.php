<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JadwalPraktikController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function (){
    Route::prefix('/home')->name('home.')->group(function (){
        Route::get('/profil', [UserController::class, "profil"])->name('profil');
        Route::put('/profil', [UserController::class, "profil_update"])->name('profil_update');
    });
}); //Profil

Route::middleware(['auth', 'role:administrator|manajer'])->group(function(){
    Route::prefix('/admin/users')->name('users.')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit");
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy");
        });
    });
}); //User

Route::middleware(['auth'])->group(function(){
    Route::prefix('/admin/pasien')->name('pasien.')->group(function(){
        Route::controller(PasienController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit");
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy");
        });
    });
}); //Pasien

Route::middleware('auth')->group(function(){
    Route::prefix('/admin/dokter')->name('dokter.')->group(function(){
        Route::controller(DokterController::class)->group(function(){
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
}); //Dokter

Route::middleware(['auth', 'role:administrator|manajer'])->group(function(){
    Route::prefix('/admin/jadwal-praktik')->name('jadwal-praktik.')->group(function(){
        Route::controller(JadwalPraktikController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit");
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy");
            Route::get('/edit/profil', "profil")->name('profil');
            Route::put('/edit/profil', "profil_update")->name('profil_update');
        });
    });
}); //Jadwal Praktik

Route::middleware('auth')->group(function(){
    Route::prefix('/admin/booking')->name('bookings.')->group(function(){
        Route::controller(BookingController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit");
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy");
            Route::get('/edit/profil', "profil")->name('profil');
            Route::put('/edit/profil', "profil_update")->name('profil_update');
        });
    });
}); //Booking

Route::middleware('auth')->group(function(){
    Route::prefix('/admin/rekam-medis')->name('rekamMedis.')->group(function(){
        Route::controller(RekamMedisController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create")->middleware(['role:administrator|manajer']);
            Route::post('/', "store")->name("store")->middleware(['role:administrator|manajer']);
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit")->middleware(['role:administrator|manajer']);
            Route::patch('/{user}', "update")->name("update")->middleware(['role:administrator|manajer']);
            Route::delete('/{user}', "destroy")->name("destroy")->middleware(['role:administrator|manajer']);
            Route::get('/edit/profil', "profil")->name('profil');
            Route::put('/edit/profil', "profil_update")->name('profil_update');
        });
    });
}); //Rekam Medis
