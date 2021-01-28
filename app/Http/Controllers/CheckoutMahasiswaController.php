<?php

namespace App\Http\Controllers;

use App\Mahasiswa;
use App\Mahasiswa_gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CheckoutMahasiswaController extends Controller
{
    public function index(){
        return view('pembina.kelola_mahasiswa.checkout_mahasiswa.index');
    }
    public function ajaxTable()
    {
        $mahasiswa = Mahasiswa::select('mahasiswas.nama','mahasiswas.user_id',
            DB::Raw("SUM(IF(mahasiswa_tagihans.keterangan = 'Belum Lunas', 1, 0)) AS jumlah_tagihan"),
            DB::Raw("SUM(IF(detail_dendas.keterangan = 'Belum Lunas', 1, 0)) AS jumlah_denda"),
            DB::Raw("SUM(IF(tugas_bulanan_mahasiswas.keterangan = 'Belum Selesai', 1, 0)) AS jumlah_tugas"))
            ->join('mahasiswa_tagihans','mahasiswas.user_id','=','mahasiswa_tagihans.mahasiswa_id')
            ->join('detail_dendas','mahasiswas.user_id','=','detail_dendas.mahasiswa_id')
            ->join('mahasiswa_gedungs','mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans','mahasiswa_gedungs.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->join('tugas_bulanan_mahasiswas','mahasiswas.user_id','=','tugas_bulanan_mahasiswas.mahasiswa_id')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_gedung->gedung_id)
            ->groupBy(['mahasiswas.nama','mahasiswas.user_id'])
            ->having('jumlah_tagihan','<',1)
            ->having('jumlah_denda','<',1)
            ->having('jumlah_tugas','<',1)
            ->get();
        return Datatables::of($mahasiswa)->toJson();
    }

    public function changeStatus($id){
        $change = Mahasiswa::where('user_id', $id)->first();
        if($change->status === 'aktif'){
            $change->status = 'tidak aktif';
            $change->update();
            Mahasiswa_gedung::where('mahasiswa_id',$id)->delete();
            return json_encode(array("success"=>"Berhasil Check Out Mahasiswa"));
        }else{
            $change->status = 'aktif';
            $change->update();
            return json_encode(array("error"=>"Gagal Check Out Mahasiswa"));
        }
    }

}
