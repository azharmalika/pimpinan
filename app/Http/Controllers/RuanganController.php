<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ruangans = Ruangan::all();

        if ($user->jabatan == 'Admin') {
            return view('admin.ruangan.index', [
                'title' => 'Data Ruangan',
                'menuAdminRuangan' => 'active',
                'ruangans' => $ruangans,
            ]);
        } elseif ($user->jabatan == 'Pimpinan') {
            return view('pimpinan.ruangan.index', [
                'title' => 'Data Ruangan',
                'menuPimpinanRuangan' => 'active',
                'ruangans' => $ruangans,
            ]);
        } else {
            return view('karyawan.ruangan.index', [
                'title' => 'Data Ruangan',
                'menuKaryawanRuangan' => 'active',
                'ruangans' => $ruangans,
            ]);
        }
    }

    public function create()
    {
        $user = Auth::user();
        $data = ['title' => 'Tambah Ruangan'];

        if ($user->jabatan == 'Admin') {
            $data['menuAdminRuangan'] = 'active';
            return view('admin.ruangan.create', $data);
        } elseif ($user->jabatan == 'Pimpinan') {
            $data['menuPimpinanRuangan'] = 'active';
            return view('pimpinan.ruangan.create', $data);
        }

        abort(403, 'Akses ditolak.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ]);

        Ruangan::create($validated);

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangan.show', compact('ruangan'));
    }

    public function edit($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.ruangan.edit', [
            'title' => 'Edit Ruangan',
            'menuAdminRuangan' => 'active',
            'ruangan' => $ruangan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $validated = $request->validate([
            'nama' => 'required|string',
            'kapasitas' => 'required|integer',
            'fasilitas' => 'nullable|string',
        ]);

        $ruangan->update($validated);

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->delete();

        return redirect()->route('ruangan')->with('success', 'Ruangan berhasil dihapus.');
    }
}
