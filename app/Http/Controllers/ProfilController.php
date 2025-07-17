<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfilController extends Controller
{
    public function index()
    {
        return view('profil.index', ['user' => Auth::user()]);
    }

    public function edit()
    {
        return view('profil.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:6',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->nama = $request->nama;
        $user->jabatan = $request->jabatan;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto); // Hapus yang lama
            }

            $path = $request->file('foto')->store('foto_profil', 'public');
            $user->foto = $path;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
