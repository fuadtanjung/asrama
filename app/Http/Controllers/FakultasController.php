<?php

namespace App\Http\Controllers;

use App\Jurusan;
use Illuminate\Http\Request;
use App\Fakultas;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FakultasController extends Controller
{
    public function index(){
        return view('pembina.kelola_data_pendaftaran.fakultas');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_fakultas' => 'required:fakultas',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $fakultas = new Fakultas();
            $fakultas->nama_fakultas = $request->nama_fakultas;
            if($fakultas->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Fakultas"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Fakultas"));
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
        $fakultas =  DB::table('fakultas')->get();
        return Datatables::of($fakultas)->toJson();
    }

    public function edit($id, Request $request){
        $fakultas = Fakultas::where('id', $id)->first();
        $fakultas->nama_fakultas = $request->nama_fakultas;
        if($fakultas->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Fakultas"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Fakultas"));
        }
    }

    public function delete($id){
        if (Jurusan::where('fakultas_id', $id)->count() === 0) {
            $fakultas = Fakultas::where('id', $id)->first();
            if($fakultas->delete()){
                return json_encode(array("success"=>"Berhasil Menghapus Data Fakultas"));
            }else{
                return json_encode(array("error"=>"Gagal Menghapus Data Fakultas"));
            }
        } else {
            return json_encode(array("error" => "Gagal Data Sedang Di Pakai"));
        }
    }
}
