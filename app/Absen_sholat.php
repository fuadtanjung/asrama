<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen_sholat extends Model
{
    protected $table = 'absen_sholats';
    protected $primaryKey = 'mahasiswa_id';
    protected $fillable = [
        'keterangan','tanggal'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
