<?php

namespace App\Http\Controllers;

use App\Mahasiswa_gedung;
use App\Ruangan;
use App\Gedung;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    public function index($id){
        $idgedung = Gedung::select('id','nama_gedung')->where('id',$id)->first();
        return view('pembina.kelola_data_pendaftaran.ruangan',['idgedung'=>$idgedung,'id'=>$id]);
    }

    public function ajaxTable($ruangan){
        $ruangans =  Ruangan::join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->select('ruangans.id','ruangans.gedung_id','ruangans.nama_ruangan','gedungs.nama_gedung','ruangans.status_ruangan')
            ->where('ruangans.gedung_id',$ruangan)
            ->get();
        return Datatables::of($ruangans)->toJson();
    }


    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'nama_ruangan' => 'required:ruangans',
            'status_ruangan' => 'required:ruangans',
            'id_gedung' => 'required:ruangans',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $ruangan = new Ruangan();
            $ruangan->nama_ruangan = $request->nama_ruangan;
            $ruangan->status_ruangan = $request->status_ruangan;
            $ruangan->gedung_id = $request->id_gedung;
            if($ruangan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Ruangan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Ruangan"));
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
            $ruangan = Ruangan::where('id', $id)->first();
            $ruangan->nama_ruangan = $request->nama_ruangan;
            $ruangan->status_ruangan = $request->status_ruangan;
            $ruangan->gedung_id = $request->id_gedung;
            if ($ruangan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Ruangan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Ruangan"));
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
        if (Mahasiswa_gedung::where('ruangan_id',$id)->count() === 0) {
            $ruangan = Ruangan::where('id', $id)->first();
            if ($ruangan->delete()) {
                return json_encode(array("success" => "Berhasil Menghapus Data Ruangan"));
            } else {
                return json_encode(array("error" => "Gagal Menghapus Data Ruangan"));
            }
        }else{
                return json_encode(array("error"=>"Gagal Data Sedang Di Pakai"));
        }
    }

    public function listGedung(){
        $gedung = Gedung::all();
        return json_encode($gedung);
    }
}
