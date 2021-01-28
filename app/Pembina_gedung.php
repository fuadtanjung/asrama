<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina_gedung extends Model
{
    protected $table = 'pembina_gedungs';
    public $timestamps = false;
    protected $fillable = [
       'pembina_id','gedung_id','tahun'
    ];

    public function gedung(){
        return $this->belongsTo(Gedung::class,'gedung_id','id');
    }
    public function pembina(){
        return $this->belongsTo(Pembina::class,'pembina_id','user_id');
    }
}
