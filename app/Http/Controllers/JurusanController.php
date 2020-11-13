<?php

namespace App\Http\Controllers;

use App\Fakultas;
use App\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index(){
        return view('pembina.jurusan');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_jurusan' => 'required|unique:jurusans',
            'fakultas' => 'required:jurusan',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $jurusan = new Jurusan();
            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->fakultas_id = $request->fakultas;
            if($jurusan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Jurusan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Jurusan"));
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
        $jurusan =  Jurusan::with(['fakultas']);
        return Datatables::of($jurusan)->toJson();
    }

    public function edit($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $jurusan = Jurusan::where('id', $id)->first();
            $jurusan->nama_jurusan = $request->nama_jurusan;
            $jurusan->fakultas_id = $request->fakultas;
            if ($jurusan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Jurusan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Jurusan"));
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
        $jurusan = Jurusan::where('id', $id)->first();
        if($jurusan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Jurusan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Jurusan"));
        }
    }

    public function listFakultas(){
        $fakultas = Fakultas::all();
        return json_encode($fakultas);
    }
}
