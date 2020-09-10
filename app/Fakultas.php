<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_fakultas'
    ];

    public function jurusan(){
        return $this->hasMany(Jurusan::class);
    }
}
