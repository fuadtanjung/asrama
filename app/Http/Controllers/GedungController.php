<?php

namespace App\Http\Controllers;

use App\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GedungController extends Controller
{
    public function index(){
        return view('pembina.gedung');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_gedung' => 'required|unique:gedungs',
            'jenis_kelamin' => 'required:gedungs',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $gedung = new Gedung();
            $gedung->nama_gedung = $request->nama_gedung;
            $gedung->gender = $request->jenis_kelamin;
            if($gedung->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Gedung"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Gedung"));
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
        $gedung =  DB::table('gedungs')->get();
        return Datatables::of($gedung)->toJson();
    }

    public function edit($id, Request $request){
        $gedung = Gedung::where('id', $id)->first();
        $gedung->nama_gedung = $request->nama_gedung;
        if($gedung->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Gedung"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Gedung"));
        }
    }

    public function delete($id){
        $gedung = Gedung::where('id', $id)->first();
        if($gedung->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Gedung"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Gedung"));
        }
    }
}
