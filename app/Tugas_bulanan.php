<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas_bulanan extends Model
{
    protected $table = 'tugas_bulanans';
    public $timestamps = false;

    public function tugas(){
        return $this->belongsTo(Tugas::class,'tugas_id','id');
    }
    public function tugas_bulanan_mahasiswa(){
        return $this->hasMany(Tugas_bulanan_mahasiswa::class);
    }
}
