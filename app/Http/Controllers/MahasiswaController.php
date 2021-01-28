<?php

namespace App\Http\Controllers;

use App\Jurusan;
use App\Jalur_masuk;
use App\Kamar_checkout;
use App\Mahasiswa_gedung;
use App\Pengalaman_organisasi;
use App\Riwayat_penyakit;
use App\Status_rumah;
use App\Goldar;
use App\Mahasiswa;
use App\Gedung;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.profile.biodatamahasiswa');
    }
    public function keluarga()
    {
        return view('mahasiswa.profile.biodatakeluarga');
    }
    public function pengalaman()
    {
        $pengalaman = Pengalaman_organisasi::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return view('mahasiswa.profile.pengalaman',compact('pengalaman'));
    }
    public function penyakit()
    {
        $penyakit = Riwayat_penyakit::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->get();
        return view('mahasiswa.profile.penyakit',compact('penyakit'));
    }

    protected function validasiData($data)
    {
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan',
            'min' => ':attribute minimal 10 nomor',
            'max' => ':attribute maximal 12 nomor'
        ];
        return validator($data, [
            'status_rumah' => 'required:mahasiswas',
            'jurusan' => 'required:mahasiswas',
            'jalur_masuk' => 'required:mahasiswas',
            'goldar' => 'required:mahasiswas',
            'nama' => 'required:mahasiswas',
            'kontak' => 'required|min:10|max:12:mahasiswas',
            'jenis_kelamin' => 'required:mahasiswas',
            'tanggal_lahir' => 'required:mahasiswas',
            'tempat_lahir' => 'required:mahasiswas',
            'alamat' => 'required:mahasiswas',
            'bidik_misi' => 'required:mahasiswas',
            'asal_sekolah' => 'required:mahasiswas',
            'agama' => 'required:mahasiswas',
            'shalat_wajib' => 'required:mahasiswas',
            'hafalan' => 'required:mahasiswas',
            'nama_ayah' => 'required:mahasiswas',
            'nama_ibu' => 'required:mahasiswas',
            'pekerjaan_ayah' => 'required:mahasiswas',
            'pekerjaan_ibu' => 'required:mahasiswas',
            'pendapatan_ayah' => 'required:mahasiswas',
            'pendapatan_ibu' => 'required:mahasiswas',
            'kontak_orang_tua' => 'required:mahasiswas',
            'anak_ke' => 'required:mahasiswas',
            'jumlah_saudara' => 'required:mahasiswas',
        ], $pesan);
    }

    public function input(Request $request)
    {
        $validasi = $this->validasiData($request->all());
        $status = 'aktif';
        if ($validasi->passes()) {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->user_id = $request->id;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->jurusan_id = $request->jurusan;
            $mahasiswa->status_rumah_id = $request->status_rumah;
            $mahasiswa->jalur_masuk_id = $request->jalur_masuk;
            $mahasiswa->goldar_id = $request->goldar;
            $mahasiswa->nama = strtoupper($request->nama);
            $mahasiswa->no_hp = $request->kontak;
            $mahasiswa->jenis_kelamin = $request->jenis_kelamin;
            $mahasiswa->tanggal_lahir = Carbon::parse($request->tanggal_lahir);
            $mahasiswa->tempat_lahir = strtoupper($request->tempat_lahir);
            $mahasiswa->alamat = strtoupper($request->alamat);
            $mahasiswa->bidik_misi = $request->bidik_misi;
            $mahasiswa->asal_sekolah = $request->asal_sekolah;
            $mahasiswa->agama = $request->agama;
            $mahasiswa->shalat_wajib = $request->shalat_wajib;
            $mahasiswa->hafalan = $request->hafalan;
            $mahasiswa->nama_ayah = strtoupper($request->nama_ayah);
            $mahasiswa->nama_ibu = strtoupper($request->nama_ibu);
            $mahasiswa->pekerjaan_ayah = $request->pekerjaan_ayah;
            $mahasiswa->pekerjaan_ibu = $request->pekerjaan_ibu;
            $mahasiswa->pendapatan_ayah = $request->pendapatan_ayah;
            $mahasiswa->pendapatan_ibu = $request->pendapatan_ibu;
            $mahasiswa->no_hp_ortu = $request->kontak_orang_tua;
            $mahasiswa->anak_ke = $request->anak_ke;
            $mahasiswa->total_saudara = $request->jumlah_saudara;
            $mahasiswa->status = $status;
            $inputmahasiswa = $mahasiswa->save();

            $gender = auth()->user()->mahasiswa->jenis_kelamin;
            $jurusan = auth()->user()->mahasiswa->jurusan_id;
            $status_ruangan = 'baik';

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
                ->leftjoin('gedungs','gedungs.id','=','ruangans.gedung_id')
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
                ->where('ruangans.status_ruangan',$status_ruangan)
                ->whereNotIn('ruangans.id',$arrJurusanSama)
                ->whereNotIn('ruangans.id',$arrKamarPenuh)
                ->get();


            $ruangan = new Mahasiswa_gedung();
            $tes = $ruangan->ruangan_id = $ruangans[0]['id'];
            $ruangan->mahasiswa_id = auth()->user()->id;
            $ruangan->mulai = date('Y-m-d');
            $ruangan->akhir = date('Y-m-d', mktime(0, 0, 0, date("m")+10,   date("d"),   date("Y")));

            if ($inputmahasiswa && $ruangan->save()) {

                $penyakit = $request->nama_penyakit;
                $count = count($penyakit);
                $id = $request->id;
                $array = [];
                for($i = 0;$i < $count ; $i++) {
                    $array[] = [
                        "mahasiswa_id" => $id,
                        "nama_penyakit" => $penyakit[$i],
                    ];
                }
                Riwayat_penyakit::insert($array);

                $organisasi = $request->nama_organisasi;
                $jabatan = $request->jabatan;
                $mulai = $request->mulai;
                $akhir = $request->akhir;
                $ids = $request->id;
                $counts = count($request->nama_organisasi);
                $arrays = [];

                for($i = 0;$i < $counts ; $i++) {
                    $arrays[] = [
                        "mahasiswa_id" => $ids,
                        "nama_organisasi" => $organisasi[$i],
                        "jabatan" => $jabatan[$i],
                        "mulai" => $mulai[$i],
                        "akhir" => $akhir[$i],
                    ];
                }

              Pengalaman_organisasi::insert($arrays);

                $kamar_checkout = new Kamar_checkout();
                $kamar_checkout->ruangan_id = $tes;
                $kamar_checkout->mahasiswa_id = auth()->user()->id;
                $kamar_checkout->save();
                return json_encode(array("success" => "Berhasil Menambahkan Data Pendaftaran"));
            } else {
                return json_encode(array("error" => "Gagal Menambahkan Data Pendaftaran"));
            }
        } else {
            $msg = $validasi->getMessageBag()->messages();
            $err = array();
            foreach ($msg as $key => $item) {
                $err[] = $item[0];
            }

            return json_encode(array("error" => $err));
        }

    }

    public function listJurusan()
    {
        $jurusan = Jurusan::all();
        return json_encode($jurusan);
    }

    public function listJalurmasuk()
    {
        $jalur_masuk = Jalur_masuk::all();
        return json_encode($jalur_masuk);
    }

    public function listStatusrumah()
    {
        $status_rumah = Status_rumah::all();
        return json_encode($status_rumah);
    }

    public function listGoldar()
    {
        $goldar = Goldar::all();
        return json_encode($goldar);
    }

    public function kamar()
    {
        $kamar = Mahasiswa::join('mahasiswa_gedungs', 'mahasiswas.user_id', '=', 'mahasiswa_gedungs.mahasiswa_id')
            ->join('ruangans', 'mahasiswa_gedungs.ruangan_id', '=', 'ruangans.id')
            ->join('gedungs', 'ruangans.gedung_id', '=', 'gedungs.id')
            ->where('user_id', auth()->user()->mahasiswa->user_id)
            ->first();
        $room = Mahasiswa_gedung::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->first();
        return view('mahasiswa.kamar',compact('kamar','room'));
    }


    public function inputsurat(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:jpeg,png,pdf|max:2048'
        ]);

        $file = $req->file('file');
        $fileName = $file->getClientOriginalName();
        $fileName = time().'.'. $fileName;
        $file->storeAs('uploads', $fileName, 'public');
        if($req->file()) {
            Mahasiswa_gedung::where('mahasiswa_id',auth()->user()->mahasiswa->user_id)->update([
                'surat_perjanjian' => $fileName
            ]);
        }
        return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
    }

    public function suratcheckout()
    {
        $tanggal = Carbon::now()->isoFormat('D MMMM Y');
        $letter = Mahasiswa::where('mahasiswas.user_id',auth()->user()->id)
            ->select(['mahasiswas.nama','mahasiswas.nim','fakultas.nama_fakultas','ruangans.nama_ruangan','pembinas.nama_pembina'])
            ->join('kamar_checkouts','mahasiswas.user_id','=','kamar_checkouts.mahasiswa_id')
            ->join('ruangans','kamar_checkouts.ruangan_id','=','ruangans.id')
            ->join('gedungs','ruangans.gedung_id','=','gedungs.id')
            ->join('pembina_gedungs','gedungs.id','=','pembina_gedungs.gedung_id')
            ->join('pembinas','pembina_gedungs.pembina_id','pembinas.user_id')
            ->join('jurusans','mahasiswas.jurusan_id','=','jurusans.id')
            ->join('fakultas','jurusans.fakultas_id','=','fakultas.id')
            ->first();
        return view('mahasiswa.checkout.suratcheckout',compact('letter','tanggal'));
    }

}
