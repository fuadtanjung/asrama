<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina_tahun extends Model
{
    protected $table = 'pembina_tahuns';
    public $timestamps = false;
    protected $fillable = [
       'tahun'
    ];

    public function pembina(){
        return $this->belongsTo(Pembina::class,'pembina_id','id');
    }
    public function pembina_gedung(){
        return $this->hasOne(Pembina_gedung::class,'pembina_id','pembina_id');
    }

}
