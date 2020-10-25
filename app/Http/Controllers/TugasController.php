<?php

namespace App\Http\Controllers;

use App\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TugasController extends Controller
{
    public function index(){
        return view('pembina.tugas');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_tugas' => 'required|unique:tugas',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $tugas = new Tugas();
            $tugas->nama_tugas = $request->nama_tugas;
            if($tugas->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Tugas"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Tugas"));
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
        $tugas =  DB::table('tugas')->get();
        return Datatables::of($tugas)->toJson();
    }

    public function edit($id, Request $request){
        $tugas = Tugas::where('id', $id)->first();
        $tugas->nama_tugas = $request->nama_tugas;
        if($tugas->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Tugas"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Tugas"));
        }
    }

    public function delete($id){
        $tugas = Tugas::where('id', $id)->first();
        if($tugas->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Tugas"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Tugas"));
        }
    }

}
