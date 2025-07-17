<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TranskripPresensiController extends Controller
{
    public function index() {
        $user = Auth::user();

        if ($user->jabatan == 'Admin') {
            return view('admin.transkrip.index', [
                'title' => 'Data agenda',
                'menuAdminTranskrip' => 'active',
                'agenda' => Agenda::with('user')->get(),
                'user' => User::where('jabatan', 'pimpinan')->get(),
            ]);
        } elseif ($user->jabatan == 'Pimpinan') {
            return view('pimpinan.transkrip.index', [
                'title' => 'Data agenda',
                'menuPimpinanTranskrip' => 'active',
                'agenda' => Agenda::with('user')->get(),
                'user' => User::where('jabatan', 'pimpinan')->get(),
            ]);
        } else {
            return view('karyawan.transkrip.index', [
                'title' => 'Data agenda',
                'menuKaryawanTranskrip' => 'active',
            ]);
        }
    }

    public function show(User $user)
    {
        // Mengambil agenda milik user (pimpinan)
        $agenda = $user->agenda()->latest()->get();

        return view('admin.transkrip.show', [
            'user' => $user,
            'agenda' => $agenda,
        ]);
    }
}
