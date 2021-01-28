<?php

namespace App\Http\Controllers;

use App\Detail_denda;
use App\Jalur_masuk;
use App\Mahasiswa_tagihan;
use App\Tugas_bulanan_mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CheckoutController extends Controller
{
    public function tagihan(){
        return view('mahasiswa.checkout.tagihan');
    }

    public function ajaxTable(){
        $tagihan = Mahasiswa_tagihan::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return Datatables::of($tagihan)->toJson();
    }

    public function uploadbukti(Request $request,$id,$bulan){
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048'
        ]);

        if($request->hasFile('file')) {
            $keterangan = 'Lunas';
            $file = $request->file('file');
            $fileName = time().'_'. $file->getClientOriginalName();
            $file->storeAs('uploads', $fileName, 'public');
            Mahasiswa_tagihan::where('bulan',$request->bln)->where('mahasiswa_id',$request->mhs2)->update([
                'surat' => $fileName,
                'keterangan' => $keterangan
            ]);
           return json_encode(array("success" => "Berhasil Upload Bukti Pembayaran"));
        }else{
            return json_encode(array("error" => "Gagal  Upload Bukti Pembayaran"));
        }
    }

    public function denda(){
        $denda =  Detail_denda::join('dendas','detail_dendas.denda_id','=','dendas.id')->where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return view('mahasiswa.checkout.denda',compact('denda'));
    }

    public function tugas(){
        $tugas = Tugas_bulanan_mahasiswa::join('tugas','tugas_bulanan_mahasiswas.tugas_bulanan_id','=','tugas.id')
            ->where('mahasiswa_id',auth()->user()->mahasiswa->user_id)
            ->get();
        return view('mahasiswa.checkout.tugas',compact('tugas'));
    }

}
