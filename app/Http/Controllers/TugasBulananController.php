<?php

namespace App\Http\Controllers;


use App\Tugas_bulanan;
use App\Tugas;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TugasBulananController extends Controller
{
    public function index(){
        $bulan = Tugas_bulanan::select('bulan')->get();
        return view('pembina.tugas_bulanan',["bulans"=>$bulan]);
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'tahun' => 'required',
            'bulan' => 'required',
            'tugas' => 'required',
        ], $pesan);
    }

    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()){
            $tugas_bulanan = new Tugas_bulanan();
            $tugas_bulanan->tahun = $request->tahun;
            $tugas_bulanan->bulan = $request->bulan;
            $tugas_bulanan->tugas_id = $request->tugas;
            if($tugas_bulanan->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Tugas Bulanan"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Tugas Bulanan"));
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
        $tugas_bulanan =  Tugas_bulanan::join('tugas','tugas_bulanans.tugas_id','tugas.id')
            ->select('tugas.nama_tugas', 'tugas_bulanans.*')
            ->get();
        $arraydata = [];
        foreach ($tugas_bulanan as $data){
            $arraydata[]= [
                "nama_tugas" => $data->nama_tugas,
                "tugas_id" => $data->tugas_id,
                "bulan" => $data->bulan,
                "tahun"=> $data->tahun,
            ];
        }
        return Datatables::of($arraydata)->toJson();
    }

    public function edit($id, Request $request){
        $validasi = $this->validasiData($request->all());
        if($validasi->passes()) {
            $tugas_bulanan = Tugas_bulanan::where('bulan',$id)->first();
            $tugas_bulanan->tahun = $request->tahun;
            $tugas_bulanan->bulan = $request->bulan;
            $tugas_bulanan->tugas_id = $request->tugas;
            if ($tugas_bulanan->update()) {
                return json_encode(array("success" => "Berhasil Merubah Data Tugas Bulanan"));
            } else {
                return json_encode(array("error" => "Gagal Merubah Data Tugas Bulanan"));
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

    public function delete($id,$bulan,$tahun){
        $tugas_bulanan = Tugas_bulanan::where('tugas_id', $id)->where('bulan',$bulan)->where('tahun',$tahun);
        if($tugas_bulanan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Tugas Bulanan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Tugas Bulanan"));
        }
    }

    public function listTugas(){
        $tugas = Tugas::all();
        return json_encode($tugas);
    }

    public function listTugasbulanan(){
        $tugas = Tugas_bulanan::with('tugas')->get();
        return json_encode($tugas);
    }
}
