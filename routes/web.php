<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalPraktikController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserController;
use App\Models\Pembayaran;
use App\Models\User;
use App\Notifications\UserVerification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
    return view('index');
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
    Route::prefix('/users')->name('users.')->group(function(){
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
    Route::prefix('/pasien')->name('pasien.')->group(function(){
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
    Route::prefix('/dokter')->name('dokter.')->group(function(){
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

Route::middleware(['auth', 'role:administrator|manajer|dokter-hewan'])->group(function(){
    Route::prefix('/jadwal-praktik')->name('jadwal-praktik.')->group(function(){
        Route::controller(JadwalPraktikController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create")->middleware('role:administrator|manajer');
            Route::post('/', "store")->name("store")->middleware('role:administrator|manajer');
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit")->middleware('role:administrator|manajer');
            Route::patch('/{user}', "update")->name("update")->middleware('role:administrator|manajer');
            Route::delete('/{user}', "destroy")->name("destroy")->middleware('role:administrator|manajer');
        });
    });
}); //Jadwal Praktik

Route::middleware('auth')->group(function(){
    Route::prefix('/booking')->name('bookings.')->group(function(){
        Route::controller(BookingController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit");
            Route::patch('/{user}', "update")->name("update");
            Route::delete('/{user}', "destroy")->name("destroy");
        });
    });
}); //Booking

Route::middleware('auth')->group(function(){
    Route::prefix('/rekam-medis')->name('rekamMedis.')->group(function(){
        Route::controller(RekamMedisController::class)->group(function(){
            Route::get('/jadwal', "redirect")->name("redirect");
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store")->middleware(['role:manajer|dokter-hewan']);
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit")->middleware(['role:manajer|dokter-hewan']);
            Route::patch('/{user}', "update")->name("update")->middleware(['role:manajer|dokter-hewan']);
            Route::delete('/{user}', "destroy")->name("destroy")->middleware(['role:manajer|dokter-hewan']);;
        });
    });
}); //Rekam Medis

Route::middleware('auth')->group(function(){
    Route::prefix('/pembayaran')->name('pembayarans.')->group(function(){
        Route::controller(PembayaranController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create")->middleware(['role:administrator|manajer']);
            Route::post('/', "store")->name("store")->middleware(['role:administrator|manajer']);
            Route::get('/{user}', "show")->name("show");
            Route::get('/{user}/edit', "edit")->name("edit")->middleware(['role:administrator|manajer|klien']);
            Route::patch('/{user}', "update")->name("update")->middleware(['role:administrator|manajer|klien']);
            Route::delete('/{user}', "destroy")->name("destroy")->middleware(['role:administrator|manajer']);
        });
    });
}); //pembayaran

Route::middleware(['auth', 'role:administrator|manajer'])->group(function(){
    Route::prefix('/reminders')->name('reminders.')->group(function(){
        Route::controller(ReminderController::class)->group(function(){
            Route::get('/', 'index')->name('index');
            Route::get('/create', "create")->name("create");
            Route::post('/', "store")->name("store");
            Route::get('/{user}', "show")->name("show");
            Route::delete('/{user}', "destroy")->name("destroy");
            Route::get('/kirim/{user}', "kirim")->name("kirim");
        });
    });
}); //reminders


//Pemberitahuan dan konfirmasi
Route::middleware(['auth'])->group(function(){
    Route::get('/pemberitahuan', [HomeController::class, 'pemberitahuan']);
}); //Rekam Medis

Route::get('/email-konfirmasi/{user_id}', function($user_id){
    $user1 =  User::find($user_id);

    $user1->verification = true;
    $user1->email_verified_at = Carbon::now();
    $user1->save();

    Session::flush();
    
    Auth::logout();

    Notification::send($user1, new UserVerification(1));

    return $user1->email . " Telah Diverifikasi ";
});


//Coba CHat
Route::middleware('auth')->group(function(){
    // Route::get('/', [MessageController::class, 'index']);
    Route::get('/messages', [MessageController::class, 'fetchMessages']);
    Route::post('/messages', [MessageController::class, 'sendMessage']);
    Route::get('/konsultasi', [MessageController::class, 'cometChat']);
});

//PDF
Route::get('/print-invoice/{id}', function($id){
    $data = Pembayaran::find($id);
    if($data->booking->rekam_medis == null){
        return "Belum ada rekam medis";
    }
    $pdf = Pdf::setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    $pdf->loadView('invoice-pdf', ['pembayaran' => $data]);
    return $pdf->stream();
    // return view('invoice-pdf', ['pembayaran'=>$data]);
})->name('print.invoice');
