<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jalur_masuk extends Model
{
    protected $table = 'jalur_masuks';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_jalur'
    ];

    public function mahasiswa(){
        return $this->hasOne(mahasiswa::class);
    }
}
