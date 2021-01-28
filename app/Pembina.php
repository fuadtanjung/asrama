<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembinas';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nama_pembina','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat_asal','pekerjaan','no_hp'
    ];

    public function postingan(){
        return $this->hasMany(Postingan::class);
    }
    public function pembina_gedung(){
        return $this->hasOne(Pembina_gedung::class,'pembina_id','user_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
