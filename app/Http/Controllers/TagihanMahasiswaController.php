<?php

namespace App\Http\Controllers;


use App\Mahasiswa_tagihan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagihanMahasiswaController extends Controller
{

    public function ajaxTable(){
        $tagihan = Mahasiswa_tagihan::with('mahasiswa')->where('mahasiswa_id')->get();
        return Datatables::of($tagihan)->toJson();
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'bulan' => 'required:tagihan',
            'keterangan' => 'required:tagihan',

        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $tagihan = new Mahasiswa_tagihan();
            $tagihan->bulan = $request->bulan;
            $tagihan->keterangan = $request->keterangan;
            $tagihan->mahasiswa_id = $request->mahasiswa;
            if($tagihan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Tagihan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Tagihan"));
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

    public function edit($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $tagihan = Mahasiswa_tagihan::where('mahasiswa_id', $id)->first();
            $tagihan->bulan = $request->bulan;
            $tagihan->keterangan = $request->keterangan;
            if ($tagihan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Tagihan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Tagihan"));
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
        $tagihan = Mahasiswa_tagihan::where('mahasiswa_id', $id)->first();
        if($tagihan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data tagihan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data tagihan"));
        }
    }
}
