<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Tugas_bulanan;
use App\Tugas_bulanan_mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TugasBulananMahasiswaController extends Controller
{
    public function index($id){
//        $mahasiswa = Mahasiswa::join('tugas_bulanan_mahasiswas', 'mahasiswas.user_id', '=', 'tugas_bulanan_mahasiswas.mahasiswa_id')
//            ->join('tugas_bulanans', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas_bulanans.tugas_id')
//            ->join('tugas', 'tugas_bulanans.tugas_id', '=', 'tugas.id')
//            ->select('tugas.*', 'tugas_bulanans.*','tugas_bulanan_mahasiswas.*','mahasiswas.*')
//            ->where('tugas_bulanan_mahasiswas.mahasiswa_id',$id)
//            ->get();
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        return view ('pembina.kelolamahasiswa.tugasbulananmahasiswa',['namamahasiswa'=>$nama,'id'=>$id]);

    }

    public function ajaxtable($mahasiswa){
        $mahasiswas = Mahasiswa::join('tugas_bulanan_mahasiswas', 'mahasiswas.user_id', '=', 'tugas_bulanan_mahasiswas.mahasiswa_id')
            ->join('tugas_bulanans', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas_bulanans.tugas_id')
            ->join('tugas', 'tugas_bulanans.tugas_id', '=', 'tugas.id')
            ->select('tugas.*', 'tugas_bulanans.*','tugas_bulanan_mahasiswas.*','mahasiswas.*')
            ->where('tugas_bulanan_mahasiswas.mahasiswa_id',$mahasiswa)
            ->get();
        $no = 1;
        $arraydata = [];
        foreach ($mahasiswas as $data){
            $arraydata[]= [
                "no" => $no,
                "tugas_bulanan_id" => $data->tugas_bulanan_id,
                "nama_tugas"=>$data->nama_tugas,
                "bulan"=>$data->bulan,
                "tahun"=>$data->tahun,
                "keterangan"=>$data->keterangan,
                ];
            $no++;
        }
        return DataTables::of($arraydata)->toJson();
    }
    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'tugas' => 'required:tugas_bulanan_mahasiswa',
            'tahun' => 'required:tugas_bulanan_mahasiswa',
            'bulan' => 'required:tugas_bulanan_mahasiswa',
            'keterangan' => 'required:tugas_bulanan_mahasiswa',
        ], $pesan);
    }

    public function inputtugasbulanan(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $tugas_bulanan_mahasiswa = new Tugas_bulanan_mahasiswa();
            $tugas_bulanan_mahasiswa->tahun = $request->tahun;
            $tugas_bulanan_mahasiswa->bulan = $request->bulan;
            $tugas_bulanan_mahasiswa->tugas_bulanan_id = $request->tugas;
            $tugas_bulanan_mahasiswa->keterangan = $request->keterangan;
            $tugas_bulanan_mahasiswa->mahasiswa_id = $request->mahasiswa;
            if($tugas_bulanan_mahasiswa->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Tugas Bulanan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Tugas Bulanan"));
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

    public function edittugasbulanan($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $tugas_bulanan_mahasiswa = tugas_bulanan_mahasiswa::where('mahasiswa_id', $id)->first();
            $tugas_bulanan_mahasiswa->tahun = $request->tahun;
            $tugas_bulanan_mahasiswa->bulan = $request->bulan;
            $tugas_bulanan_mahasiswa->tugas_bulanan_id = $request->tugas;
            $tugas_bulanan_mahasiswa->keterangan = $request->keterangan;
            if ($tugas_bulanan_mahasiswa->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Tugas Bulanan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Tugas Bulanan"));
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

    public function delete($id){
        $tugas_bulanan_mahasiswa = Tugas_bulanan_mahasiswa::where('tugas_bulanan_id', $id)->first();
        if($tugas_bulanan_mahasiswa->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data tugas_bulanan_mahasiswa"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data tugas_bulanan_mahasiswa"));
        }
    }

    public function listTugas(){
        $tugas = Tugas_bulanan::with(['tugas'])->get();
        return json_encode($tugas);
    }
}
