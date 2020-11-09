<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Mahasiswa;
use App\Mahasiswa_gedung;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    public function index(){
        $ruangan = Ruangan::all();
        return view('pembina.checkin.kamarmahasiswa',compact('ruangan'));
    }

    public function choice($id){
        $mahasiswa = DB::table("mahasiswas")->whereNotIn("user_id", function($query){
            $query->select("mahasiswa_id")->from("mahasiswa_gedungs");
        })->get();
        return view('pembina.checkin.pilihmahasiswa',compact('mahasiswa','id'));
    }

    public function input(Request $request, $id){
        $mahasiswa_gedung = new Mahasiswa_gedung();
        $mahasiswa_gedung->mahasiswa_id = $request->mahasiswa_id;
        $mahasiswa_gedung->ruangan_id = $id;
        $mahasiswa_gedung->mulai = now();
        $mahasiswa_gedung->akhir = now();
        $mahasiswa_gedung->save();
    }








//    public function input(){
//        $kamar = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
//            ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
//            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
//            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
//            ->get();
//
//        if (count($kamar) == 0)
//        {
//            $ruangan = Ruangan::select('ruangans.id','ruangans.gedung_id','ruangans.nama_ruangan','gedungs.id','gedungs.nama_gedung','gedungs.gender')->join('gedungs','ruangans.gedung_id','=','gedungs.id')->where('gedungs.gender',auth()->user()->mahasiswa->jenis_kelamin)->first();
//            $mahasiswa_gedung = Mahasiswa_gedung::create([
//                "ruangan_id" => $ruangan->id,
//                "mahasiswa_id"  => auth()->user()->id,
//                "mulai" => "2020-10-01",
//                "akhir" => "2021-10-01",
//                "surat_perjanjian"   => "test"
//            ]);
//        }
//        elseif (count($kamar) > 0)
//        {
//            $gedung = Gedung::where('gender',auth()->user()->mahasiswa->jenis_kelamin)->get();
//
//
//            foreach($gedung as $data)
//            {
//                foreach($data->ruangan as $ruangan)
//                {
//                    $hitung = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
//                        ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
//                        ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
//                        ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
//                        ->where('ruangans.id', $ruangan->id)
//                        ->get();
//
//                    if(count($hitung) < 4)
//                    {
//                        $jurusan = Mahasiswa_gedung::select('mahasiswa_gedungs.*','mahasiswas.*','jurusans.id','jurusans.nama_jurusan','jurusans.fakultas_id')->join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','=','mahasiswas.user_id')
//                            ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
//                            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
//                            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
//                            ->where('ruangans.id', $ruangan->id)
//                            ->where('jurusans.id','!=',auth()->user()->mahasiswa->jurusan->id)
//                            ->get();
//
////                        dd($jurusan);
//
//                        foreach($jurusan as $data_jurusan)
//                        {
//                            if($data_jurusan->nama_jurusan == auth()->user()->mahasiswa->jurusan->nama_jurusan)
//                            {
//                                return "test";
//                            }
//                            elseif(){
//
//                                 $mahasiswa_gedung = Mahasiswa_gedung::create([
//                                    "ruangan_id" => $ruangan->id,
//                                    "mahasiswa_id"  => 3,
//                                    "mulai" => "2020-10-02",
//                                    "akhir" => "2021-10-02",
//                                    "surat_perjanjian"   => "test"
//                                ]);
//                                return "test2";
//                            }
//                        }
//
//                        $mahasiswa_gedung = Mahasiswa_gedung::create([
//                            "ruangan_id" => $ruangan->id,
//                            "mahasiswa_id"  => auth()->user()->id,
//                            "mulai" => "2020-10-02",
//                            "akhir" => "2021-10-02",
//                            "surat_perjanjian"   => "test"
//                        ]);
//
//                        return "test";
//                    }
//
//                }
//            }
//
//        }
//
//        return "success";
//
//    }
}
