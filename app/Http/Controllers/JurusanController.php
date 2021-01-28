<?php

namespace App\Http\Controllers;

use App\Fakultas;
use App\Jurusan;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function index($id){
        $fakultas = Fakultas::where('id',$id)->first();
        return view('pembina.kelola_data_pendaftaran.jurusan',['fakultas'=>$fakultas,'id'=>$id]);
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

    public function ajaxTable($jurusan){
        $jurusans =  Jurusan::join('fakultas','jurusans.fakultas_id','=','fakultas.id')
            ->where('jurusans.fakultas_id',$jurusan)
            ->get();
        return Datatables::of($jurusans)->toJson();
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
        if (Mahasiswa::where('jurusan_id', $id)->count() === 0) {
            $jurusan = Jurusan::where('id', $id)->first();
            if($jurusan->delete()){
                return json_encode(array("success"=>"Berhasil Menghapus Data Jurusan"));
            }else{
                return json_encode(array("error"=>"Gagal Menghapus Data Jurusan"));
            }
        } else {
            return json_encode(array("error" => "Gagal Data Sedang Di Pakai"));
        }
    }

    public function listFakultas(){
        $fakultas = Fakultas::all();
        return json_encode($fakultas);
    }
}
