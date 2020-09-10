<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_jurusan'
    ];

    public function fakultas(){
        return $this->belongsTo(fakultas::class,'fakultas_id','id');
    }
    public function mahasiswa(){
        return $this->hasOne(Mahasiswa::class);
    }
}
