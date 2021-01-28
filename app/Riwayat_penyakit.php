<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat_penyakit extends Model
{
    protected $table = 'riwayat_penyakits';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_penyakit','mahasiswa_id'
    ];

    public function mahasiswa(){
        return $this->belongsToMany(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
