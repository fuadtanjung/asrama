<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status_rumah extends Model
{
    protected $table = 'status_rumahs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_status'
    ];

    public function mahasiswa(){
        return $this->hasOne(mahasiswa::class);
    }
}
