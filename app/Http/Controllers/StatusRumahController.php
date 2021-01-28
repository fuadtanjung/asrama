<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Status_rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class StatusRumahController extends Controller
{
    public function index(){
        return view('pembina.kelola_data_pendaftaran.statusrumah');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_status' => 'required|unique:status_rumahs',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $statusrumah= new Status_rumah();
            $statusrumah->nama_status = $request->nama_status;
            if($statusrumah->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Status Rumah"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Status Rumah"));
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
        $statusrumah =  DB::table('status_rumahs')->get();
        return Datatables::of($statusrumah)->toJson();
    }

    public function edit($id, Request $request){
        $statusrumah = Status_rumah::where('id', $id)->first();
        $statusrumah->nama_status = $request->nama_status;
        if($statusrumah->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Status Rumah"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Status Rumah"));
        }
    }

    public function delete($id)
    {
        if (Mahasiswa::where('status_rumah_id', $id)->count() === 0) {
            $statusrumah = Status_rumah::where('id', $id)->first();
            if ($statusrumah->delete()) {
                return json_encode(array("success" => "Berhasil Menghapus Data Status Rumah"));
            } else {
                return json_encode(array("error" => "Gagal Menghapus Data Status Rumah"));
            }
        } else {
            return json_encode(array("error" => "Gagal Data Sedang Di Pakai"));
        }
    }
}
