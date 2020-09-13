<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Gedung;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    public function index(){
        return view('pembina.ruangan');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_ruangan' => 'required|unique:ruangans',
            'gedung' => 'required:ruangans',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $ruangan = new Ruangan();
            $ruangan->nama_ruangan = $request->nama_ruangan;
            $ruangan->gedung_id = $request->gedung;
            if($ruangan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Ruangan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Ruangan"));
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
        $ruangan =  Ruangan::with(['gedung']);
        return Datatables::of($ruangan)->toJson();
    }

    public function edit($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $ruangan = Ruangan::where('id', $id)->first();
            $ruangan->nama_ruangan = $request->nama_ruangan;
            $ruangan->gedung_id = $request->gedung;
            if ($ruangan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Ruangan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Ruangan"));
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
        $ruangan = Ruangan::where('id', $id)->first();
        if($ruangan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Ruangan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Ruangan"));
        }
    }

    public function listGedung(){
        $gedung = Gedung::all();
        return json_encode($gedung);
    }
}
