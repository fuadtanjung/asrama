<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denda extends Model
{
    protected $table = 'dendas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nama_denda','denda'
    ];

    public function detaildenda(){
        return $this->hasMany(Detail_denda::class);
    }
}
