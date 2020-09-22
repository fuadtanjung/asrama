<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_tagihan extends Model
{
    protected $table = 'mahasiswa_tagihans';
    protected $primaryKey = 'mahasiswa_id';
    public $timestamps= false;
    protected $fillable = [
        'keterangan','bulan'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
