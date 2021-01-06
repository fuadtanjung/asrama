<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Tugas_bulanan;
use App\Tugas_bulanan_mahasiswa;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TugasBulananMahasiswaController extends Controller
{
    public function index($id){
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        return view ('pembina.checkout.tugas.tugasbulananmahasiswa',['namamahasiswa'=>$nama,'id'=>$id]);
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
                "id" => $data->id,
                "mahasiswa_id" => $data->mahasiswa_id,
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
            'unique' => ':attribute ini sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'tugas' => "required:tugas_bulanan_mahasiswas",
            'keterangan' => 'required:tugas_bulanan_mahasiswa',
        ], $pesan);
    }

    public function input(Request $request){
        $tgs = $request->tugas;
        $mhs = $request->mahasiswa;
        if (Tugas_bulanan_mahasiswa::where('tugas_bulanan_id',$tgs )->where('mahasiswa_id',$mhs)->count() == 0) {
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
        } else {
            return json_encode(array("error"=>"Tugas ini Sudah ada"));
        }
    }

    public function edit(Request $request,$tgs,$mhs){
       $tugas_bulanan_mahasiswa = Tugas_bulanan_mahasiswa::where('tugas_bulanan_id',$tgs )
           ->where('mahasiswa_id',$mhs)
           ->update([
               'tahun' => $request->tahun,
               'bulan' => $request->bulan,
               'tugas_bulanan_id' => $request->tugas,
               'keterangan' => $request->keterangan,
               'mahasiswa_id' => $request->mahasiswa
           ]);
        if ($tugas_bulanan_mahasiswa) {
            return json_encode(array("success" => "Berhasil Merubah Data Tugas Bulanan"));
        } else {
            return json_encode(array("error" => "Gagal Merubah Data Tugas Bulanan"));
        }
    }

    public function delete($id,$bulan,$tahun,$mhs){
        $tugas_bulanan_mahasiswa = Tugas_bulanan_mahasiswa::where('tugas_bulanan_id', $id)->where('bulan',$bulan)->where('tahun',$tahun)->where('mahasiswa_id',$mhs);
        if($tugas_bulanan_mahasiswa->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Denda Mahasiswa"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Denda Mahasiswa"));
        }
    }
}
