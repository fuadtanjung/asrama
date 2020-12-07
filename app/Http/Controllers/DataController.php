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
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.kelolamahasiswa.datamahasiswa',compact('mahasiswa'));
    }

    public function indextugasbulanan(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.checkout.tugas.datatugas',compact('mahasiswa'));
    }

    public function indextagihan(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.checkout.tagihan.datatagihan',compact('mahasiswa'));
    }

    public function indexdenda(){
        $mahasiswa = Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.checkout.denda.datadenda',compact('mahasiswa'));
    }

    public function detailmahasiswa($id){
        $mahasiswa = Mahasiswa::where('user_id',$id)->get();
        $pengalaman = Pengalaman_organisasi::where('mahasiswa_id',$id)->get();
        $riwayat_penyakit = Riwayat_penyakit::where('mahasiswa_id',$id)->get();
        return view('pembina.kelolamahasiswa.detailmahasiswa',compact('mahasiswa','pengalaman','riwayat_penyakit'));
    }

    public function surat(){
        return view('mahasiswa.surat');
    }

    public function printtugas(){
        $printtugas = Tugas_bulanan_mahasiswa::join('tugas_bulanans', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas_bulanans.tugas_id')
            ->join('tugas', 'tugas_bulanans.tugas_id', '=', 'tugas.id')
            ->join('mahasiswas', 'tugas_bulanan_mahasiswas.mahasiswa_id', '=', 'mahasiswas.user_id')
            ->select('mahasiswas.nama','tugas.nama_tugas',
                'tugas_bulanan_mahasiswas.bulan','tugas_bulanan_mahasiswas.tahun',
                'tugas_bulanan_mahasiswas.keterangan')
            ->get();
        return view('pembina.checkout.tugas.print',compact('printtugas'));
    }

}
