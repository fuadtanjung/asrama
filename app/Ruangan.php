<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangans';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_ruangan'
    ];

    public function gedung(){
        return $this->belongsTo(Gedung::class,'gedung_id','id');
    }
    public function mahasiswa_gedung(){
        return $this->hasMany(Mahasiswa_gedung::class);
    }
    public function kamar_checkout(){
        return $this->hasMany(Kamar_checkout::class);
    }
}
