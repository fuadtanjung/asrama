<?php

namespace App\Http\Controllers;

use App\Pengalaman_organisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class PengalamanorganisasiController extends Controller
{
    public function index(){
        return view('checkout_mahasiswa.pengalaman_organisasi');
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_organisasi' => 'required',
            'mulai' => 'required',
            'akhir' => 'required',
            'jabatan' => 'required',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $pengalaman_organisasi = new Pengalaman_organisasi();
            $pengalaman_organisasi->nama_organisasi = $request->nama_organisasi;
            $pengalaman_organisasi->mulai =Carbon::parse($request->mulai);
            $pengalaman_organisasi->akhir = Carbon::parse($request->akhir);
            $pengalaman_organisasi->jabatan = $request->jabatan;
            $pengalaman_organisasi->mahasiswa_id = auth()->user()->mahasiswa->user_id;
            if($pengalaman_organisasi->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Pengalaman Organisasi"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Pengalaman Organisasi"));
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
        $pengalaman_organisasi = Pengalaman_organisasi::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return Datatables::of($pengalaman_organisasi)->toJson();
    }

    public function edit($id, Request $request){
        $pengalaman_organisasi = Pengalaman_organisasi::where('id', $id)->first();
        $pengalaman_organisasi->nama_organisasi = $request->nama_organisasi;
        $pengalaman_organisasi->mulai =Carbon::parse($request->mulai);
        $pengalaman_organisasi->akhir = Carbon::parse($request->akhir);
        $pengalaman_organisasi->jabatan = $request->jabatan;
        $pengalaman_organisasi->mahasiswa_id = auth()->user()->mahasiswa->user_id;
        if($pengalaman_organisasi->update()){
            return json_encode(array("success"=>"Berhasil Merubah Data Pengalaman Organisasi"));
        }else{
            return json_encode(array("error"=>"Gagal Merubah Data Pengalaman Organisasi"));
        }
    }

    public function delete($id){
        $pengalaman_organisasi = Pengalaman_organisasi::where('id', $id)->first();
        if($pengalaman_organisasi->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Pengalaman Organisasi"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Pengalaman Organisasi"));
        }
    }
}
