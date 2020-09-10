<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goldar extends Model
{
    protected $table = 'goldars';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_goldar'
    ];

    public function mahasiswa(){
        return $this->hasOne(mahasiswa::class);
    }
}
