<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedungs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_gedung','jenis_kelamin'
    ];

    public function ruangan(){
        return $this->hasMany(Ruangan::class);
    }
    public function pembina_gedung(){
        return $this->hasMany(Pembina_gedung::class);
    }
}
