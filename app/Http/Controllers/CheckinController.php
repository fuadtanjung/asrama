<?php

namespace App\Http\Controllers;

use App\Mahasiswa_gedung;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    public function index(){

        $ruangan = Ruangan::join('gedungs','ruangans.gedung_id','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','pembina_gedungs.gedung_id')
            ->select('ruangans.id','ruangans.nama_ruangan','gedungs.nama_gedung')
            ->where('pembina_gedungs.gedung_id',auth()->user()->pembina->pembina_tahun->pembina_gedung->gedung_id)
            ->get();
        return view('pembina.checkin.kamarmahasiswa',compact('ruangan'));
    }

    public function choice($id){
        $mahasiswa = DB::table("mahasiswas")->whereNotIn("user_id", function($query){
            $query->select("mahasiswa_id")->from("mahasiswa_gedungs");
        })->get();
        return view('pembina.checkin.pilihmahasiswa',compact('mahasiswa','id'));
    }

    public function input(Request $request, $id){

        $request->validate([
            "mahasiswa_id" => 'required',
        ]);

        $mahasiswa_gedung = new Mahasiswa_gedung();
        $mahasiswa_gedung->mahasiswa_id = $request->mahasiswa_id;
        $mahasiswa_gedung->ruangan_id = $id;
        $mahasiswa_gedung->mulai = now();
        $mahasiswa_gedung->akhir = now();
        $mahasiswa_gedung->save();
        return back()->with('success','Berhasil Di Tambahkan.');
    }

    public function indexmhs($id){
        $checkroom = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','mahasiswas.user_id')
        ->join('ruangans','mahasiswa_gedungs.ruangan_id','ruangans.id')
        ->where('ruangan_id',$id)->get();
        return view('pembina.checkin.checkroom',compact('checkroom'));
    }

    public function unduh($id,$mhs){
        $surat = Mahasiswa_gedung::where('ruangan_id',$id)->where('mahasiswa_id',$mhs)->first();
        $path = storage_path()."\app\public\uploads\\$surat->surat_perjanjian";
        if($surat->surat_perjanjian == null)
        {
            return redirect()->back()->with('failed','Gagal mengunduh file');
        }

        return response()->download($path);
    }

    public function getRoom(){
        $gender = auth()->user()->mahasiswa->jenis_kelamin;
        $jurusan = auth()->user()->mahasiswa->jurusan_id;


       $jurusansama = Mahasiswa_gedung::select('ruangans.id')
                       ->leftjoin('mahasiswas', 'mahasiswas.user_id','=','mahasiswa_gedungs.mahasiswa_id')
                       ->leftjoin('ruangans','ruangans.id','=','mahasiswa_gedungs.ruangan_id')
                       ->where('mahasiswas.jurusan_id',$jurusan)
                       ->distinct()->get();
        $arrJurusanSama = array();


        foreach ($jurusansama as $key) {
            array_push($arrJurusanSama,$key['id']);

        }

        $kamarpenuh = Mahasiswa_gedung::select('ruangans.id')
        ->leftjoin('ruangans','ruangans.id','=','mahasiswa_gedungs.ruangan_id')
        ->leftjoin('gedungs','gedungs.id','=','ruangans.id')
        ->groupBy('mahasiswa_gedungs.ruangan_id')
        ->having(DB::raw('count(*)'), '=', 4)
        ->distinct()->get();

        $arrKamarPenuh = array();
        foreach ($kamarpenuh as $key) {
            array_push($arrKamarPenuh,$key['id']);
        }


        $ruangans = Ruangan::select('ruangans.id','gedungs.nama_gedung')
                    ->leftjoin('gedungs', 'gedungs.id', '=', 'ruangans.gedung_id')
                    ->where('gedungs.gender',$gender)
                    ->whereNotIn('ruangans.id',$arrJurusanSama)
                    ->whereNotIn('ruangans.id',$arrKamarPenuh)
                    ->get();

        if(empty($ruangans)){
            return response()->json(['isAvailable'=>'false','result'=> 'Tidak ada kamar tersedia saat ini']);
        }


        $ruangan = new Mahasiswa_gedung();
        $ruangan->ruangan_id = $ruangans[0]['id'];
        $ruangan->mahasiswa_id = auth()->user()->mahasiswa->user_id;
        $ruangan->mulai = date('Y-m-d');
        $ruangan->akhir = date('Y-m-d');
        $ruangan->save();
        return response()->json(['isAvailable'=>'true','result'=> [$ruangan]]);
    }
}
