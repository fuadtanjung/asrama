<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_tagihan extends Model
{
    protected $table = 'mahasiswa_tagihans';
    protected $primaryKey = 'bulan';
    protected $keyType = 'string';
    public $timestamps= false;
    protected $fillable = [
       'mahasiswa_id','keterangan','bulan','jumlah','surat'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'user_id','mahasiswa_id');
    }
}
