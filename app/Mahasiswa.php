<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nim','nama','no_hp','jenis_kelamin','tanggal_lahir','tempat_lahir',
        'alamat','bidik_misi','asal_sekolah','agama','shalat_wajib','hafalan',
        'nama_ayah','nama_ibu','pekerjaan_ayah','pekerjaan_ibu','pendapatan_ayah',
        'pendapatan_ibu','no_hp_ortu','anak_ke','total_saudara'
    ];

    public function jurusan(){
        return $this->belongsTo(Jurusan::class,'jurusan_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function goldar(){
        return $this->belongsTo(Goldar::class,'goldar_id','id');
    }
    public function jalur_masuk(){
        return $this->belongsTo(Jalur_masuk::class,'jalur_masuk_id','id');
    }
    public function status_rumah(){
        return $this->belongsTo(Status_rumah::class,'status_rumah_id','id');
    }

    public function pengalamanorganisasi(){
        return $this->hasMany(Pengalaman_organisasi::class,'mahasiswa_id');
    }

    public function mahasiswatagihan(){
        return $this->hasMany( Mahasiswa_tagihan::class,'mahasiswa_id');
    }

    public function tugasbulananmahasiswa(){
        return $this->hasMany( Tugas_bulanan_mahasiswa::class,'mahasiswa_id');
    }

}
