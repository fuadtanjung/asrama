<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_tagihan extends Model
{
    protected $table = 'mahasiswa_tagihans';
    protected $fillable = [
        'keterangan'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
