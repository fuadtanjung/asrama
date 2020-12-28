<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class AkunPembinaController extends Controller
{
    public function index(){
        return view('pembina.akun.akunpembina');
    }

    public function ajaxTable(){
        $akunpembina =  DB::table('users')->where('role_id','=',1)->get();
        return Datatables::of($akunpembina)->toJson();
    }

    protected function  validasiData($data){
            $pesan = [
                'required' => ':attribute tidak boleh kosong',
                'unique' => ':attribute sudah ada',
                'exists' => ':attribute tidak ditemukan'
            ];
            return validator($data, [
                'nama_pembina' => 'required:users',
                'nim' => 'required|unique:users,nim',
                'password_pembina' => 'required:users',
            ], $pesan);
    }



    public function input(Request $request){
        $validasi = $this->validasiData($request->all());
        $role = 1;
        if($validasi->passes()){
            $pembina = new User;
            $pembina->name = $request->nama_pembina;
            $pembina->nim = $request->nim;
            $pembina->role_id = $role;
            $pembina->password = bcrypt($request->password_pembina);
            $pembina->remember_token = Str::random(30);
            if($pembina->save()){
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

    protected function  validasiData2($data,$id){
        $pesan = [
            'required' => ':attribute tidak boleh kosong',
            'unique' => ':attribute sudah ada',
            'exists' => ':attribute tidak ditemukan'
        ];

        return validator($data, [
            'nama_pembina' => 'required:users',
            'nim' => "required|unique:users,nim,$id",
            'password_pembina' => 'required:users',
        ], $pesan);
    }

    public function edit(Request $request,$id){
        $validasi = $this->validasiData2($request->all(),$id);
        if($validasi->passes()){
            $pembina = User::where('id', $id)->first();
            $pembina->name = $request->nama_pembina;
            $pembina->nim = $request->nim;
            $pembina->password = bcrypt($request->password_pembina);
            if($pembina->update()){
                return json_encode(array("success"=>"Berhasil Merubah Data pembina"));
            }else{
                return json_encode(array("errors"=>"Gagal Merubah Data pembina"));
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

    public function delete($id){
        $pembina = User::where('id', $id)->first();
        if($pembina->delete()){
            return json_encode(array("success"=>"Berhasil Menghapus Data pembina"));
        }else{
            return json_encode(array("error"=>"Gagal Menghapus Data pembina"));
        }
    }

}
