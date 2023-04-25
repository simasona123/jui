<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Flash;

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
        $pasien = Pasien::where('user_id', $user->id)->get();
        if(count($pasien) == 0){
            Flash::success('Silahkan daftarkan hewan peliharaan terlebih dahulu');
            return redirect()->route('pasien.create');
        }
        return view('home');
    }
}
