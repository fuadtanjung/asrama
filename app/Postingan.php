<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $table = 'postingans';
    protected $fillable = [
        'judul','keterangan','waktu_post'
    ];

    public function pembina(){
        return $this->belongsTo(Pembina::class,'pembina_id','id');
    }
}
