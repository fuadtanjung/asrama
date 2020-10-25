<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Mahasiswa;
use App\Mahasiswa_gedung;
use App\Ruangan;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index($id){
//        $mahasiswa = Mahasiswa::join('tugas_bulanan_mahasiswas', 'mahasiswas.user_id', '=', 'tugas_bulanan_mahasiswas.mahasiswa_id')
//            ->join('tugas_bulanans', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas_bulanans.tugas_id')
//            ->join('tugas', 'tugas_bulanans.tugas_id', '=', 'tugas.id')
//            ->select('tugas.*', 'tugas_bulanans.*','tugas_bulanan_mahasiswas.*','mahasiswas.*')
//            ->where('tugas_bulanan_mahasiswas.mahasiswa_id',$id)
//            ->get();
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        return view ('pembina.checkout.tugas.tugasbulananmahasiswa',['namamahasiswa'=>$nama,'id'=>$id]);

    }

    public function input(){
        $kamar = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
            ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->get();

        if (count($kamar) == 0)
        {
            $ruangan = Ruangan::select('ruangans.id','ruangans.gedung_id','ruangans.nama_ruangan','gedungs.id','gedungs.nama_gedung','gedungs.gender')->join('gedungs','ruangans.gedung_id','=','gedungs.id')->where('gedungs.gender',auth()->user()->mahasiswa->jenis_kelamin)->first();
            $mahasiswa_gedung = Mahasiswa_gedung::create([
                "ruangan_id" => $ruangan->id,
                "mahasiswa_id"  => auth()->user()->id,
                "mulai" => "2020-10-01",
                "akhir" => "2021-10-01",
                "surat_perjanjian"   => "test"
            ]);
        }
        elseif (count($kamar) > 0)
        {
            $gedung = Gedung::where('gender',auth()->user()->mahasiswa->jenis_kelamin)->get();


            foreach($gedung as $data)
            {
                foreach($data->ruangan as $ruangan)
                {
                    $hitung = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
                        ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
                        ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                        ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                        ->where('ruangans.id', $ruangan->id)
                        ->get();

                    if(count($hitung) < 4)
                    {
                        $jurusan = Mahasiswa_gedung::select('mahasiswa_gedungs.*','mahasiswas.*','jurusans.id','jurusans.nama_jurusan','jurusans.fakultas_id')->join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
                            ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
                            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                            ->where('ruangans.id', $ruangan->id)
                            ->where('jurusans.id','!=',auth()->user()->mahasiswa->jurusan->id)
                            ->get();

//                        dd($jurusan);

                        foreach($jurusan as $data_jurusan)
                        {
                            if($data_jurusan->nama_jurusan == auth()->user()->mahasiswa->jurusan->nama_jurusan)
                            {
                                return "test";
                            }
                            elseif(){

                                $mahasiswa_gedung = Mahasiswa_gedung::create([
                                    "ruangan_id" => $ruangan->id,
                                    "mahasiswa_id"  => 3,
                                    "mulai" => "2020-10-02",
                                    "akhir" => "2021-10-02",
                                    "surat_perjanjian"   => "test"
                                ]);
                                return "test2";
                            }
                        }

                        $mahasiswa_gedung = Mahasiswa_gedung::create([
                            "ruangan_id" => $ruangan->id,
                            "mahasiswa_id"  => auth()->user()->id,
                            "mulai" => "2020-10-02",
                            "akhir" => "2021-10-02",
                            "surat_perjanjian"   => "test"
                        ]);

                        return "test";
                    }

                }
            }

        }

        return "success";

    }
}
