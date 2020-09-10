<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_denda extends Model
{
    protected $table = 'detail_dendas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'keterangan','waktu'
    ];

    public function fakultas(){
        return $this->belongsTo(Denda::class,'denda_id','id');
    }
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
