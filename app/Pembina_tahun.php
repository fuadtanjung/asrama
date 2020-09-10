<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina_tahun extends Model
{
    protected $table = 'pembina_tahuns';
    protected $fillable = [
       'tahun'
    ];

    public function pembina(){
        return $this->belongsTo(Pembina::class,'pembina_id','id');
    }
}
