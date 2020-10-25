<?php

namespace App\Http\Controllers;

use App\Denda;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DendaController extends Controller
{
    public function index(){
        return view('pembina.denda');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_denda' => 'required|unique:dendas',
            'denda' => 'required:dendas',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $denda = new Denda();
            $denda->nama_denda= $request->nama_denda;
            $denda->denda = $request->denda;
            if($denda->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Denda"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Denda"));
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
        $denda =  Denda::all();
        return Datatables::of($denda)->toJson();
    }

    public function edit($id, Request $request){
        $denda = Denda::where('id', $id)->first();
        $denda->nama_denda = $request->nama_denda;
        $denda->denda = $request->denda;
        if($denda->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Denda"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Denda"));
        }
    }

    public function delete($id){
        $denda = Denda::where('id', $id)->first();
        if($denda->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Denda"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Denda"));
        }
    }

    public function listDenda(){
        $denda = Denda::all();
        return json_encode($denda);
    }
}
