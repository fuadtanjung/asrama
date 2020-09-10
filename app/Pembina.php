<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    protected $table = 'pembinas';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nama','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat_asal','pekerjaan','no_hp'
    ];

    public function postingan(){
        return $this->hasMany(Postingan::class);
    }
    public function pembina_tahun(){
        return $this->hasOne(Pembina_tahun::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
