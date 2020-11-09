<?php

namespace App\Http\Controllers;

use App\Detail_denda;
use App\Mahasiswa_tagihan;
use App\Tugas_bulanan_mahasiswa;
use Yajra\DataTables\Facades\DataTables;

class CheckoutController extends Controller
{
    public function tagihan(){
        $tagihan = Mahasiswa_tagihan::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return view('mahasiswa.checkout.tagihan',compact('tagihan'));
    }

    public function denda(){
        $denda =  Detail_denda::join('dendas','detail_dendas.denda_id','=','dendas.id')->where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return view('mahasiswa.checkout.denda',compact('denda'));
    }

    public function tugas(){
        $tugas = Tugas_bulanan_mahasiswa::join('tugas_bulanans','tugas_bulanan_mahasiswas.tugas_bulanan_id','=','tugas_bulanans.tugas_id')
            ->join('tugas','tugas_bulanans.tugas_id','=','tugas.id')
            ->where('mahasiswa_id',auth()->user()->mahasiswa->user_id)
            ->get();
        return view('mahasiswa.checkout.tugas',compact('tugas'));
    }

}
