<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AkunPembinaController extends Controller
{
    public function index(){
        return view('pembina.akun.akunpembina');
    }

    public function ajaxTable(){
        $akunpembina =  DB::table('users')->select('name','nim')->where('role_id','=',1)->get();
        return Datatables::of($akunpembina)->toJson();
    }


}
