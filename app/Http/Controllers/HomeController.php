<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Packages\MyModules;
use App\Models\Pasien;
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
        $pasiens = Pasien::with('bookings')->where('user_id', $user->id)->get();
        dd($pasiens);
        return view('home', [
            "user" => $user,
        ]);
    }

    public function pemberitahuan(){
        $user = Auth::user();
        $role = $user->getRoleNames()[0];
        $user->unreadNotifications->markAsRead();
        return redirect(route('home'));
    }

   
}
