<?php

namespace App\Http\Controllers;

use App\Goldar;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GoldarController extends Controller
{
    public function index(){
        return view('pembina.kelola_data_pendaftaran.goldar');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_goldar' => 'required|unique:goldars',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $goldar = Goldar::create([
                "nama_goldar"  => $request->nama_goldar,
            ]);
            if($goldar){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Golongan Darah"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Golongan Darah"));
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
        $goldar =  DB::table('goldars')->get();
        return Datatables::of($goldar)->toJson();
    }

    public function edit($id, Request $request){
        $goldar = Goldar::where('id', $id)->first();
        $goldar->nama_goldar = $request->nama_goldar;
        if($goldar->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Goldar"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Goldar"));
        }
    }

    public function delete($id)
    {
        if (Mahasiswa::where('goldar_id', $id)->count() === 0) {
            $goldar = Goldar::where('id', $id)->first();
            if ($goldar->delete()) {
                return json_encode(array("success" => "Berhasil Menghapus Data Goldar"));
            } else {
                return json_encode(array("error" => "Gagal Menghapus Data Goldar"));
            }
        } else {
            return json_encode(array("error" => "Gagal Data Sedang Di Pakai"));
        }
    }
}
