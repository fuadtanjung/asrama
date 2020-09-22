<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_tugas'
    ];

    public function tugas_bulanan(){
        return $this->hasMany(Tugas_bulanan::class,'tugas_id');
    }
}
