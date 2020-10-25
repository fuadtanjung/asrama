<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen_sholat extends Model
{
    protected $table = 'absen_sholats';
    public $timestamps = false;
    protected $fillable = [
        'mahasiswa_id','keterangan','tanggal'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
