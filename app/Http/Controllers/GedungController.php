<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class GedungController extends Controller
{
    public function index(){
        return view('pembina.kelola_data_pendaftaran.gedung');
    }

    public function ajaxTable(){
        $gedung =  DB::table('gedungs')->get();
        return Datatables::of($gedung)->toJson();
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

    protected function  validasiDataEdit($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_gedung' => 'required:gedungs',
            'jenis_kelamin' => 'required:gedungs',
        ], $pesan);
    }

    public function edit($id, Request $request){
        $validasi = $this->validasiDataEdit($request->all());
        if($validasi->passes()){
            $gedung = Gedung::where('id', $id)->update([
                'nama_gedung' => $request->nama_gedung,
                'gender' => $request->jenis_kelamin
            ]);
            if($gedung){
                return json_encode(array("success"=>"Berhasil Merubah Data Gedung"));
            }else{
                return json_encode(array("error"=>"Gagal Merubah Data Gedung"));
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
        if (Ruangan::where('gedung_id',$id)->count() === 0) {
            $gedung = Gedung::where('id', $id)->first();
            if($gedung->delete()){
                return json_encode(array("success"=>"Berhasil Menghapus Data Gedung"));
            }else{
                return json_encode(array("error"=>"Gagal Menghapus Data Gedung"));
            }
        }else{
            return json_encode(array("error"=>"Gagal Data Sedang Di Pakai"));
        }
    }

    public function listGedung()
    {
        $gedung = Gedung::all();
        return json_encode($gedung);
    }

}
