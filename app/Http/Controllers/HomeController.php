<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Packages\MyModules;
use App\Models\Booking;
use App\Models\JadwalPraktik;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        if(MyModules::cek_pasien_pertama($user, $role) == -1)return redirect()->route('pasien.create');
        $data = ["user" => $user,];

        if($role == 'klien'){
            $pasiens = Pasien::with(['bookings' => function($q){
                $q->orderBy('completed', 'asc')->get();
            }])->where('user_id', $user->id)->get();
            $data['pasiens'] = $pasiens;
        }

        else{
            $jadwal_praktik = JadwalPraktik::with('bookings')->whereHas('bookings')->whereDate('tanggal_masuk', ">=", Carbon::now())->orderBy('tanggal_masuk', 'asc')->get();
            $data['jadwal_praktiks'] = $jadwal_praktik;
        }
        


        return view('home', $data);
    }

    public function pemberitahuan(){ // Tandai Pemberitahuan
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        $user->unreadNotifications->markAsRead();
        return redirect(route('home'));
    }

   
}
