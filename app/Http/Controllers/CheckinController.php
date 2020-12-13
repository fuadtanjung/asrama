<?php

namespace App\Http\Controllers;

use App\Mahasiswa_gedung;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    public function index(){
//        $ruangan = Mahasiswa_gedung::join('mahasiswas','mahasiswa_gedungs.mahasiswa_id','mahasiswas.user_id')
//            ->join('ruangans','mahasiswa_gedungs.ruangan_id','ruangans.id')
//            ->select('ruangans.*','mahasiswa_gedungs.mahasiswa_id')
//            ->get();
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
        $path = public_path()."\storage\uploads\\$surat->surat_perjanjian";
        return response()->download($path);
    }

 public function getRoom(){
        $gender = auth()->user()->mahasiswa->jenis_kelamin;
        $jurusan = auth()->user()->mahasiswa->jurusan_id;
    //kamar yang bisa ditempati dengan jurusan berbeda
// SELECT DISTINCT ruangans.id from ruangans
// LEFT JOIN gedungs ON gedungs.id = ruangans.gedung_id
// WHERE (ruangans.id NOT IN (SELECT mahasiswa_gedungs.ruangan_id from mahasiswa_gedungs
//       LEFT JOIN mahasiswas ON mahasiswas.user_id = mahasiswa_gedungs.mahasiswa_id
//       WHERE mahasiswas.jurusan_id = 9))
// AND (gedungs.gender = 'perempuan')
// AND (ruangans.id NOT IN
//     (SELECT DISTINCT ruangans.id FROM `mahasiswa_gedungs`
//     LEFT JOIN ruangans ON ruangans.id = mahasiswa_gedungs.ruangan_id
//     LEFT JOIN gedungs ON gedungs.id = ruangans.id
//     GROUP BY mahasiswa_gedungs.ruangan_id
//     HAVING COUNT(*) = 4))

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

//        $ruangan = $ruangans[0];

        $ruangan = new Mahasiswa_gedung();
        $ruangan->ruangan_id = $ruangans[0]['id'];
        $ruangan->mahasiswa_id = auth()->user()->mahasiswa->user_id;
        $ruangan->mulai = date('Y-m-d');
        $ruangan->akhir = date('Y-m-d');
        $ruangan->save();
        return response()->json(['isAvailable'=>'true','result'=> [$ruangan]]);
    }
}
