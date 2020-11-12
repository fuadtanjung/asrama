<?php

namespace App\Http\Controllers;

use App\Detail_denda;
use App\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DendaMahasiswaController extends Controller
{
    public function index($id){
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        return view ('pembina.checkout.denda.dendamahasiswa',['namamahasiswa'=>$nama,'id'=>$id]);
    }

    public function ajaxtable($detail_denda){
        $detail_dendas = Detail_denda::join('dendas', 'detail_dendas.denda_id', '=', 'dendas.id')
            ->join('mahasiswas', 'detail_dendas.mahasiswa_id', '=', 'mahasiswas.user_id')
            ->select('detail_dendas.*', 'dendas.nama_denda','dendas.denda','mahasiswas.*')
            ->where('detail_dendas.mahasiswa_id',$detail_denda)
            ->get();
        $no = 1;
        $arraydata = [];
        foreach ($detail_dendas as $data){
            $arraydata[]= [
                "no" => $no,
                "id" => $data->id,
                "denda_id" => $data->denda_id,
                "mahasiswa_id" => $data->mahasiswa_id,
                "nama_denda"=>$data->nama_denda,
                "denda"=>$data->denda,
                "keterangan"=>$data->keterangan,
            ];
            $no++;
        }
        return DataTables::of($arraydata)->toJson();
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'denda' => 'required:detail_dendas',
            'keterangan' => 'required:detail_dendas',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $detail_denda = new Detail_denda();
            $detail_denda->denda_id = $request->denda;
            $detail_denda->keterangan = $request->keterangan;
            $detail_denda->mahasiswa_id = $request->mahasiswa;
            $detail_denda->waktu = date('Y-m-d');
            if($detail_denda->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Denda Mahasiswa"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Denda Mahasiswa"));
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
            $detail_denda = Detail_denda::where('id',$id)->first();
            $detail_denda->denda_id = $request->denda;
            $detail_denda->keterangan = $request->keterangan;
            $detail_denda->mahasiswa_id = $request->mahasiswa;
            if ($detail_denda->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Denda Mahasiswa"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Denda Mahasiswa"));
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

    public function delete($id,$mhs){
        $detail_denda = Detail_denda::where('id', $id)->where('mahasiswa_id',$mhs)->first();
        if($detail_denda->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Denda Mahasiswa"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Denda Mahasiswa"));
        }
    }
}
