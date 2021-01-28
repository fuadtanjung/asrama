<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar_checkout extends Model
{
    protected $table = 'kamar_checkouts';
    public $timestamps = false;
    protected $fillable = [
        'mahasiswa_id','ruangan_id'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id','id');
    }
}
