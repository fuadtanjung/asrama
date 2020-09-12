<?php

namespace App\Http\Controllers;

use App\Jalur_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JalurMasukController extends Controller
{
    public function index(){
        return view('pembina.jalur_masuk');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_jalur' => 'required|unique:jalur_masuks',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $jalur= new Jalur_masuk();
            $jalur->nama_jalur = $request->nama_jalur;
            if($jalur->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Jalur Masuk"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Jalur Masuk"));
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
        $jalur =  DB::table('jalur_masuks')->get();
        return Datatables::of($jalur)->toJson();
    }

    public function edit($id, Request $request){
        $jalur = Jalur_masuk::where('id', $id)->first();
        $jalur->nama_jalur = $request->nama_jalur;
        if($jalur->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Jalur Masuk"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Jalur Masuk"));
        }
    }

    public function delete($id){
        $jalur = Jalur_masuk::where('id', $id)->first();
        if($jalur->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Jalur Masuk"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Jalur Masuk"));
        }
    }
}
