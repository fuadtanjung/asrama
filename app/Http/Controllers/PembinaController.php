<?php

namespace App\Http\Controllers;

use App\Pembina;
use App\Pembina_gedung;
use App\Pembina_tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PembinaController extends Controller
{
    public function index()
    {
        $profilepembina = Pembina::where('user_id', auth()->user()->id)->get();
        return view('pembina.profilpembina',['pembina'=>$profilepembina]);
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama' => 'required:pembina',
            'kontak' => 'required:pembina',
            'jenis_kelamin' => 'required:pembina',
            'pekerjaan' => 'required:pembina',
            'tanggal_lahir' => 'required:pembina',
            'tempat_lahir' => 'required:pembina',
            'alamat' => 'required:pembina',
            'gedung' => 'required',
            'tahun' => 'required',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $pembina = new pembina();
            $pembina->user_id= $request->id;
            $pembina->nim = $request->nim;
            $pembina->nama = $request->nama;
            $pembina->no_hp = $request->kontak;
            $pembina->jenis_kelamin = $request->jenis_kelamin;
            $pembina->pekerjaan = $request->pekerjaan;
            $pembina->tanggal_lahir =Carbon::parse($request->tanggal_lahir);
            $pembina->tempat_lahir = $request->tempat_lahir;
            $pembina->alamat_asal = $request->alamat;
            if($pembina->save()){

                $pembina_tahun = new Pembina_tahun();
                $pembina_tahun->pembina_id = $request->id;
                $pembina_tahun->tahun = $request->tahun;
                $pembina_tahun->save();

                $pembina_gedung = new Pembina_gedung();
                $pembina_gedung->pembina_id = $request->id;
                $pembina_gedung->gedung_id = $request->gedung;
                $pembina_gedung->tahun = $request->tahun;
                $pembina_gedung->save();

                return json_encode(array("success"=>"Berhasil Menambahkan Data Pembina"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Pembina"));
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

}
