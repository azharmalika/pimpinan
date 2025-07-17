<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view ('auth/login');
    }

    public function loginProses(Request $request){
        $request->validate([
            'email'    => 'required',
            'password' => 'required|min:8',
        ],[
            'email.required'      => 'Email Tidak Boleh Kosong',
            'password.required'   => 'Password Tidak Boleh Kosong',
            'password.min'        => 'Password Minimal 8 Karakter',
        ]);

        $data = [
            'email'      => $request->email,
            'password'   => $request->password,
        ];

        if (Auth::attempt($data)) { // Perbaikan di sini
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error','Email atau Password Salah');
        }
    }
}
