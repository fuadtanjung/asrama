<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas_bulanan_mahasiswa extends Model
{
    protected $table = 'tugas_bulanan_mahasiswas';
    protected $primaryKey = 'mahasiswa_id';
    public $timestamps = false;
    protected $fillable = [
        'tugas_bulanan_id','mahasiswa_id','bulan','tahun','keterangan',
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
    public function tugas_bulanan(){
        return $this->belongsTo(Tugas::class,'tugas_bulanan_id','id');
    }
}
