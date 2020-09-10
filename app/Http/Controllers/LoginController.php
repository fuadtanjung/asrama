<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'login'  => 'required',
            'loginpassword' => 'required',
        ]);

        $fieldType = filter_var($request->login, FILTER_VALIDATE_INT) ? 'nim' : 'nim';
        if(Auth::attempt([$fieldType => $request->login, 'password' => $request->loginpassword]))
        {
            return redirect()->route('home')->with('success','Selamat datang');
        }
        return redirect()->route('login.index')->with('failed','Username atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}


