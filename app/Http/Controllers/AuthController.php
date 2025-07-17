<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auth/login');
    }
    public function loginProses(Request $request){
        $request->validate([
            'email'     =>'required',
            'password'  =>'required|min:8',
        ],[
            'email.required'      =>'Email Tidak Boleh Kosong',
            'password.required'   =>'Password Tidak Boleh Kosong',
            'password.min'       
             =>'Password Minimal 8 Karakter',
        ]);

        $data=[
            'email' =>$request->email,
            'password'  =>$request->password,
        ];

        if (\Illuminate\Support\Facades\Auth::attempt($data)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }

    public function logout (){
        Auth::logout();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}
