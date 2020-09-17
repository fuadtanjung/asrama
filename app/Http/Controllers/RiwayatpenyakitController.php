<?php

namespace App\Http\Controllers;

use App\Riwayat_penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RiwayatpenyakitController extends Controller
{
    public function index(){
        return view('mahasiswa.riwayat_penyakit');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_penyakit' => 'required:riwayat_penyakit',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $riwayat_penyakit = new riwayat_penyakit();
            $riwayat_penyakit->nama_penyakit = $request->nama_penyakit;
             $riwayat_penyakit->mahasiswa_id = auth()->user()->mahasiswa->user_id;
            if($riwayat_penyakit->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Riwayat Penyakit"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Riwayat_Penyakit"));
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

    public function ajaxTable(){
        $riwayat_penyakit =  Riwayat_penyakit::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return Datatables::of($riwayat_penyakit)->toJson();
    }

    public function edit($id, Request $request){
        $riwayat_penyakit = Riwayat_penyakit::where('id', $id)->first();
        $riwayat_penyakit->nama_penyakit = $request->nama_penyakit;
        if($riwayat_penyakit->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Riwayat Penyakit"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Riwayat Penyakit"));
        }
    }

    public function delete($id){
        $riwayat_penyakit = Riwayat_penyakit::where('id', $id)->first();
        if($riwayat_penyakit->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Riwayat Penyakit"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Riwayat Penyakit"));
        }
    }
}
