<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }
    public function loginProses(Request $request)
    {
        $request->validate([
            'emailOrUsername' => 'required|string',
            'password'  => 'required|min:8',
        ], [
            'emailOrUsername.required'      => 'Email atau Username Tidak Boleh Kosong',
            'password.required'             => 'Password Tidak Boleh Kosong',
            'password.min'                  => 'Password Minimal 8 Karakter',
        ]);

        $login_type = filter_var($request->emailOrUsername, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Buat array untuk percobaan login
        $credentials = [
            $login_type => $request->emailOrUsername,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Anda Berhasil Logout');
    }
}
