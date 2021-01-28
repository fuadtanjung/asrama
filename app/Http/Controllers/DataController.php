<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Pengalaman_organisasi;
use App\Riwayat_penyakit;
use App\Tugas;
use App\Tugas_bulanan;
use App\Tugas_bulanan_mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataController extends Controller
{
    public function index(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.kelola_mahasiswa.data_mahasiswa.datamahasiswa',compact('mahasiswa'));
    }

    public function indextugasbulanan(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.kelola_mahasiswa.kartu_checkout.tugas.datatugas',compact('mahasiswa'));
    }

    public function indextagihan(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.kelola_mahasiswa.kartu_checkout.tagihan.datatagihan',compact('mahasiswa'));
    }

    public function indexdenda(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.kelola_mahasiswa.kartu_checkout.denda.datadenda',compact('mahasiswa'));
    }

    public function detailmahasiswa($id){
        $mahasiswa = Mahasiswa::where('user_id',$id)->get();
        $pengalaman = Pengalaman_organisasi::where('mahasiswa_id',$id)->get();
        $riwayat_penyakit = Riwayat_penyakit::where('mahasiswa_id',$id)->get();
        return view('pembina.kelola_mahasiswa.data_mahasiswa.detailmahasiswa',compact('mahasiswa','pengalaman','riwayat_penyakit'));
    }

    public function surat(){
        return view('mahasiswa.surat');
    }

    public function arsip(){
        $mahasiswa = Mahasiswa::where('mahasiswas.status','=','tidak aktif')
            ->with(['jurusan','status_rumah','jalur_masuk','goldar'])
            ->get();
        return view('pembina.arsip.arsipmahasiswa',compact('mahasiswa'));
    }
}
