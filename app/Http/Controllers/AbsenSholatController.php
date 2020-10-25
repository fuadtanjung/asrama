<?php

namespace App\Http\Controllers;

use App\Absen_sholat;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AbsenSholatController extends Controller
{

    public function index(){
        $mhs= Mahasiswa::all();
        $hadir = Absen_sholat::all();
        $waktu = Absen_sholat::where('tanggal',date('Y-m-d'))->get();
        return view('pembina.kelolamahasiswa.absensholat',compact('mhs','hadir','waktu'));
    }

    public function ajaxTable(Request $request){
        $find = Absen_sholat::join('mahasiswas','absen_sholats.mahasiswa_id','mahasiswas.user_id')
            ->where('tanggal',$request->tanggal);
        $no = 1;
        $arraydata= [];
        foreach ($find as $data){
            $arraydata[]=[
                "no" =>$no,
                "nama" =>$data->nama,
                "keterangan" =>$data->keterangan,
            ];
            $no++;
        }
        return DataTables::of($arraydata)->toJson();
    }

    public function input(Request $request){
        $check = $request-> chkbox;
        foreach ($check  as $wow) {
            $absens = Absen_sholat::create([
                "mahasiswa_id" => $wow,
                "keterangan" => "hadir",
                "tanggal" => date('Y-m-d'),
            ]);
        }
        if($absens){
            return json_encode(array("success"=>"Berhasil Menambahkan Data Absen"));
        }else{
            return json_encode(array("error"=>"Gagal Menambahkan Data Absen"));
        }
    }

//    public function search(Request $request){
//        $find = Absen_sholat::where('tanggal',$request->tanggal);
//        return view ('pembina.kelolamahasiswa.absensholat',compact('find'));
//    }

}
