<?php

namespace App\Http\Controllers;


use App\Mahasiswa;
use App\Mahasiswa_tagihan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TagihanMahasiswaController extends Controller
{

    public function index($id){
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        return view ('pembina.checkout.tagihan.tagihanmahasiswa',['namamahasiswa'=>$nama,'id'=>$id]);
    }

    public function ajaxTable($tagihan){
        $tagihan = Mahasiswa_tagihan::with('mahasiswa')
            ->where('mahasiswa_id',$tagihan)->get();
        return Datatables::of($tagihan)->toJson();
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'bulan' => 'required:mahasiswa_tagihans',
            'keterangan' => 'required:tagihan',
        ], $pesan);
    }

    public function input(){
        $bln = request()->bulan;
        $mhs = request()->mahasiswa;
        if (Mahasiswa_tagihan::where('bulan',$bln )->where('mahasiswa_id',$mhs)->count() == 0) {
            $validasi = $this->validasiData(request()->all());
            if ($validasi->passes()) {
                $tagihan = Mahasiswa_tagihan::create([
                    'bulan' => request()->bulan,
                    'keterangan' => request()->keterangan,
                    'mahasiswa_id' => request()->mahasiswa,
                ]);
                if ($tagihan) {
                    return json_encode(array("success" => "Berhasil Menambahkan Data Tagihan"));
                } else {
                    return json_encode(array("error" => "Gagal Menambahkan Data Tagihan"));
                }
            } else {
                $msg = $validasi->getMessageBag()->messages();
                $err = array();
                foreach ($msg as $key => $item) {
                    $err[] = $item[0];
                }

                return json_encode(array("error" => $err));
            }
        } else {
            return json_encode(array("error"=>"Tagihan Bulan ini Sudah ada"));
        }
    }

    public function edit($bulan,$mhs, Request $request){
        $tagihan = Mahasiswa_tagihan::where('bulan', $bulan)
            ->where('mahasiswa_id',$mhs)
            ->update([
                'bulan' => $request->bulan,
                'keterangan' => $request->keterangan,
                'mahasiswa_id' => $request->mahasiswa
            ]);
        if ($tagihan) {
            return json_encode(array("success" => "Berhasil Merubah Data Tagihan"));
        } else {
            return json_encode(array("error" => "Gagal Merubah Data Tagihan"));
        }
    }

    public function delete($id, $bulan){
        $tagihan = Mahasiswa_tagihan::where('mahasiswa_id',$id)->where('bulan', $bulan);
        if($tagihan->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data tagihan"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data tagihan"));
        }
    }
}
