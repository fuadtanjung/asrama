<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected function  validasiData($data){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute tidak boleh sama',
            'exists' => ':attribute tidak ditemukan',
            'min' => ':attribute minimal 10 nomor',
            'max' => ':attribute maximal 10 nomor',
        ];
        return validator($data, [
            'nama' => 'required',
            'nim' => 'required||min:10|max:10|unique:users',
            'password' => 'required',
        ], $pesan);
    }


    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        $role = 2;
        if($validasi->passes()){
            $user = new User();
            $user->name = $request->nama;
            $user->nim = $request->nim;
            $user->role_id = $role;
            $user->password = bcrypt($request->password);
            $user->remember_token = Str::random(30);

            $user->save();

            if($user->save()){
                return json_encode(array("success"=>"Berhasil Menambahkan Data Pengguna"));
            }else{
                return json_encode(array("error"=>"Gagal Menambahkan Data Pengguna"));
            }
        }else{
            $msg = $validasi->getMessageBag()->messages();
            $err = array();
            foreach ($msg as $key=>$item) {
                $err[] = $item[0];
            }

            return json_encode(array("error"=>$err));
        }
    }
}
