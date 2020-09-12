<?php

namespace App\Http\Controllers;

use App\Goldar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GoldarController extends Controller
{
    public function index(){
        return view('pembina.goldar');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_goldar' => 'unique|required:goldar',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $goldar = new Goldar();
            $goldar->nama_goldar = $request->nama_goldar;
            if($goldar->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Goldar"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Goldar"));
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

    public function delete($id){
        $goldar = Goldar::where('id', $id)->first();
        if($goldar->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Goldar"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Goldar"));
        }
    }
}
