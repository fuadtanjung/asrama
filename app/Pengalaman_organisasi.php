<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengalaman_organisasi extends Model
{
    protected $table = 'pengalaman_organisasis';
    protected $primaryKey = 'id';
    public $timestamps= false;
    protected $fillable = [
       'nama_organisasi','mulai','akhir','jabatan'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','user_id');
    }
}
