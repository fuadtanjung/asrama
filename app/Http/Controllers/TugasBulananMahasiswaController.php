<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Tugas_bulanan;
use App\Tugas_bulanan_mahasiswa;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TugasBulananMahasiswaController extends Controller
{
    public function index($id){
        $nama = Mahasiswa::select('nama','user_id')->where('user_id',$id)->first();
        $bulan = Carbon::now()->monthName;
        return view ('pembina.kelola_mahasiswa.kartu_checkout.tugas.tugasbulananmahasiswa',['namamahasiswa'=>$nama,'id'=>$id,'bulan'=>$bulan]);
    }

    public function ajaxtable($mahasiswa){
        $mahasiswas = Mahasiswa::join('tugas_bulanan_mahasiswas', 'mahasiswas.user_id', '=', 'tugas_bulanan_mahasiswas.mahasiswa_id')
            ->join('tugas', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas.id')
            ->select('tugas.*','tugas_bulanan_mahasiswas.*','mahasiswas.*')
            ->where('tugas_bulanan_mahasiswas.mahasiswa_id',$mahasiswa)
            ->get();
        $no = 1;
        $arraydata = [];
        foreach ($mahasiswas as $data){
            $arraydata[]= [
                "no" => $no,
                "tugas_bulanan_id" => $data->tugas_bulanan_id,
                "id" => $data->id,
                "mahasiswa_id" => $data->mahasiswa_id,
                "nama_tugas"=>$data->nama_tugas,
                "bulan"=>$data->bulan,
                "tahun"=>$data->tahun,
                "keterangan"=>$data->keterangan,
            ];
            $no++;
        }
        return DataTables::of($arraydata)->toJson();
    }

    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute ini sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];
        return validator($data, [
            'tugas' => "required:tugas_bulanan_mahasiswas",
            'keterangan' => 'required:tugas_bulanan_mahasiswa',
        ], $pesan);
    }

    public function input(Request $request){
        $mhs = $request->mahasiswa;
        $bln = $request->bulan;
        if (Tugas_bulanan_mahasiswa::where('bulan',$bln)
                ->where('mahasiswa_id',$mhs)
                ->count() === 0 ) {
            $validasi = $this->validasiData($request->all());
            if ($validasi->passes()) {
                $tugas_bulanan_mahasiswa = new Tugas_bulanan_mahasiswa();
                $tugas_bulanan_mahasiswa->tahun = Carbon::now()->year;
                $tugas_bulanan_mahasiswa->bulan = Carbon::now()->monthName;
                $tugas_bulanan_mahasiswa->tugas_bulanan_id = $request->tugas;
                $tugas_bulanan_mahasiswa->keterangan = $request->keterangan;
                $tugas_bulanan_mahasiswa->mahasiswa_id = $mhs;
                if ($tugas_bulanan_mahasiswa->save()) {
                    return json_encode(array("success" => "Berhasil Menambahkan Data Tugas Bulanan"));
                } else {
                    return json_encode(array("error" => "Gagal Menambahkan Data Tugas Bulanan"));
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
            return json_encode(array("error"=>"Tugas Bulan ini Sudah ada"));
        }
    }

    public function edit(Request $request,$tgs,$mhs){
       $tugas_bulanan_mahasiswa = Tugas_bulanan_mahasiswa::where('tugas_bulanan_id',$tgs )
           ->where('mahasiswa_id',$mhs)
           ->update([
               'tahun' =>Carbon::now()->year,
               'bulan' => $request->bulan,
               'tugas_bulanan_id' => $request->tugas,
               'keterangan' => $request->keterangan,
               'mahasiswa_id' => $request->mahasiswa
           ]);
        if ($tugas_bulanan_mahasiswa) {
            return json_encode(array("success" => "Berhasil Merubah Data Tugas Bulanan"));
        } else {
            return json_encode(array("error" => "Gagal Merubah Data Tugas Bulanan"));
        }
    }

    public function delete($id,$bulan,$tahun,$mhs){
        $tugas_bulanan_mahasiswa = Tugas_bulanan_mahasiswa::where('tugas_bulanan_id', $id)->where('bulan',$bulan)->where('tahun',$tahun)->where('mahasiswa_id',$mhs);
        if($tugas_bulanan_mahasiswa->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data Denda Mahasiswa"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data Denda Mahasiswa"));
        }
    }

    public function printtugas(Request $request){
        $mulai = $request->mulai;
        $akhir = $request->akhir;
        if($request->filled('mulai') && $request->filled('akhir')){
            $printtugas = Tugas_bulanan_mahasiswa::join('tugas', 'tugas_bulanan_mahasiswas.tugas_bulanan_id','=','tugas.id')
                ->join('mahasiswas', 'tugas_bulanan_mahasiswas.mahasiswa_id', '=', 'mahasiswas.user_id')
                ->join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
                ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
                ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
                ->whereBetween('tugas_bulanan_mahasiswas.bulan', [$mulai, $akhir])
                ->select('mahasiswas.nama','tugas.nama_tugas',
                    'tugas_bulanan_mahasiswas.bulan','tugas_bulanan_mahasiswas.tahun',
                    'tugas_bulanan_mahasiswas.keterangan')
                ->get();
        }else{
            $printtugas=  Tugas_bulanan_mahasiswa::join('tugas', 'tugas_bulanan_mahasiswas.tugas_bulanan_id', '=', 'tugas.id')
                ->join('mahasiswas', 'tugas_bulanan_mahasiswas.mahasiswa_id', '=', 'mahasiswas.user_id')
                ->join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
                ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
                ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
                ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
                ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
                ->select('mahasiswas.nama','tugas.nama_tugas',
                    'tugas_bulanan_mahasiswas.bulan','tugas_bulanan_mahasiswas.tahun',
                    'tugas_bulanan_mahasiswas.keterangan')
                ->get();
        }
        return view('pembina.kelola_mahasiswa.kartu_checkout.tugas.print',(['printtugas'=>$printtugas]));
    }
}
