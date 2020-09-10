<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_gedung extends Model
{
    protected $table = 'mahasiswa_gedungs';
    protected $fillable = [
        'mulai','akhir','surat_perjanjian'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id','id');
    }
}
