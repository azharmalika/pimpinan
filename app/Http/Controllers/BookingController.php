<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showBooking($ruangan_id)
    {
        $ruangan = Ruangan::findOrFail($ruangan_id);
        $bookings = Booking::where('ruangan_id', $ruangan_id)->orderBy('tanggal')->get();

        $jabatan = Auth::user()->jabatan;

        // Arahkan view berdasarkan jabatan
        if ($jabatan == 'Admin') {
            return view('admin.booking.show', compact('ruangan', 'bookings'));
        } elseif ($jabatan == 'Pimpinan') {
            return view('pimpinan.booking.show', compact('ruangan', 'bookings'));
        } else {
            return view('karyawan.booking.show', compact('ruangan', 'bookings'));
        }
    }

    public function create($ruangan_id)
    {
        $ruangan = Ruangan::findOrFail($ruangan_id);
        $jabatan = Auth::user()->jabatan;

        if ($jabatan == 'Admin') {
            return view('admin.booking.create', compact('ruangan'));
        } elseif ($jabatan == 'Pimpinan') {
            return view('pimpinan.booking.create', compact('ruangan'));
        } else {
            return view('karyawan.booking.create', compact('ruangan'));
        }
    }

    public function store(Request $request)
    {
        // Validasi awal
        $request->validate([
            'ruangan_id'     => 'required|exists:ruangans,id',
            'nama_peminjam'  => 'required|string',
            'tanggal'        => 'required|date',
            'waktu_mulai'    => 'required',
            'waktu_selesai'  => 'required',
            'keperluan'      => 'nullable|string',
        ]);
    
        // ⛔ Validasi waktu selesai harus lebih besar dari waktu mulai
        if ($request->waktu_selesai <= $request->waktu_mulai) {
            return back()->with('error', 'Waktu selesai harus lebih besar dari waktu mulai!');
        }
    
        // 🔍 Cek bentrok dengan jadwal lain
        $isConflict = Booking::where('ruangan_id', $request->ruangan_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                      });
            })
            ->exists();
        
        if ($isConflict) {
            return back()->with('error', 'Ruangan sudah dibooking di tanggal dan jam tersebut!');
        }
    
        // ✅ Booking disimpan
        Booking::create($request->all());
    
        return redirect()->route('ruangan.show', $request->ruangan_id)
            ->with('success', 'Ruangan berhasil dibooking!');
    }
}
