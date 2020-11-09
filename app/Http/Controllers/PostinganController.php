<?php

namespace App\Http\Controllers;

use App\Postingan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PostinganController extends Controller
{
    public function index(){
        return view('pembina.postingan');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'judul' => 'required:postingans',
            'keterangan' => 'required:postingans',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $postingan = new Postingan();
            $postingan->judul = $request->judul;
            $postingan->keterangan = $request->keterangan;
            $postingan->waktu_post = $request->tanggal;
            $postingan->pembina_id = $request->pembina;
            if($postingan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Postingan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Postingan"));
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
        $postingan =  Postingan::get();
        return Datatables::of($postingan)->toJson();
    }

    public function edit($id, Request $request){
        $postingan = postingan::where('id', $id)->first();
        $postingan->judul = $request->judul;
        $postingan->keterangan = $request->keterangan;
        $postingan->waktu_post = date('Y-m-d');
        $postingan->pembina_id = $request->pembina;
        if($postingan->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Postingan"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Postingan"));
        }
    }

    public function delete($id){
        $postingan = postingan::where('id', $id)->first();
        if($postingan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Postingan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Postingan"));
        }
    }

    public function pengumuman(){
        $pengumuman = Postingan::get();
        return view('mahasiswa.postinganmahasiswa',['post' => $pengumuman]);
    }
}
