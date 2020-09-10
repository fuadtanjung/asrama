<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_penyakit extends Model
{
    protected $table = 'riwayat_penyakits';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_penyakit'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
