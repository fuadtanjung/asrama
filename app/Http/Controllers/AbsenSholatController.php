<?php

namespace App\Http\Controllers;

use App\Absen_sholat;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AbsenSholatController extends Controller
{

    public function index(){
        $mhs= Mahasiswa::join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->get();
        $hadir = Absen_sholat::all();
        $waktu = Absen_sholat::where('tanggal',date('Y-m-d'))->get();
        return view('pembina.kelola_mahasiswa.absen_sholat.absensholat',compact('mhs','hadir','waktu'));
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

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'mahasiswa' => 'required',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
            if($validasi->passes()){
            $check = $request-> mahasiswa;
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
        }else{
            $msg = $validasi->getMessageBag()->messages();
            $err = array();
            foreach ($msg as $key=>$item) {
                $err[] = $item[0];
            }
            return json_encode(array("error"=>$err));
        }
    }
    public function print(Request $request)
    {
        $mulai = $request->mulai;
        $akhir = $request->akhir;
        if($request->filled('mulai') && $request->filled('akhir')){
            $absen = Absen_sholat::join('mahasiswas','absen_sholats.mahasiswa_id','=','mahasiswas.user_id')
                ->join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
                ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
                ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
                ->whereBetween('tanggal', [$mulai, $akhir])
                ->get();
        }else{
            $absen =  Absen_sholat::join('mahasiswas','absen_sholats.mahasiswa_id','=','mahasiswas.user_id')
                ->join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
                ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
                ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
                ->get();
        }
        return view('pembina.kelola_mahasiswa.absen_sholat.printabsen',(['absen'=>$absen]));
    }
}
