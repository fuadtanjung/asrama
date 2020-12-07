<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Pembina;
use Illuminate\Http\Request;
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
        $mahasiswa = Mahasiswa::where('user_id', auth()->user()->id)->get();
        $pembina = Pembina::where('user_id', auth()->user()->id)->get();
        return view('home',['asrama'=>$mahasiswa,'pembina'=>$pembina]);
    }
}
