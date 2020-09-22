<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Tugas;
use App\Tugas_bulanan;
use App\Tugas_bulanan_mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::all();
        return view('pembina.kelolamahasiswa.datamahasiswa',compact('mahasiswa'));
    }

    public function detailmahasiswa($id){
        $mahasiswa = Mahasiswa::where('user_id',$id)->get();
        return view('pembina.kelolamahasiswa.detailmahasiswa',['detailmahasiswa'=>$mahasiswa]);
    }

//    {{--TUGAS BULANAN--}}



//    {{----END TUGAS BULANAN-------}}


//{{---TAGIHAN MAHASISWA}}

    public function tagihanmahasiswa($id){
        $mahasiswa = Mahasiswa::with('mahasiswatagihan')->where('user_id',$id)->get();
        return view('pembina.kelolamahasiswa.tagihanmahasiswa',['tagihanmahasiswa'=>$mahasiswa]);
    }



}
