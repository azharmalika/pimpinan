<?php

namespace App\Http\Controllers;

use App\Exports\AgendaExport;
use App\Models\Agenda;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AgendaController extends Controller
{
    public function index() {
        $user = Auth::user();

        if ($user->jabatan == 'Admin') {
            return view('admin.agenda.index', [
                'title' => 'Data agenda',
                'menuAdminAgenda' => 'active',
                'agenda' => Agenda::with('user')->get(),
                'user' => User::where('jabatan', 'pimpinan')->get(),
            ]);
        } elseif ($user->jabatan == 'Pimpinan') {
            return view('pimpinan.agenda.index', [
                'title' => 'Data agenda',
                'menuPimpinanAgenda' => 'active',
                'agenda' => Agenda::with('user')->get(),
                'user' => User::where('jabatan', 'pimpinan')->get(),
            ]);
        } else {
            return view('karyawan.agenda.index', [
                'title' => 'Data agenda',
                'menuKaryawanAgenda' => 'active',
            ]);
        }
    }
    public function beranda(){
        // Menampilkan agenda yang tanggalnya adalah hari ini
        $today = date('Y-m-d');

        $agendaHariIni = Agenda::with('user')
        ->whereDate('tanggal_mulai', $today)
        ->get()
        ->groupBy('user.name'); // Dikelompokkan berdasarkan nama pimpinan

    return view('welcome', compact('agendaHariIni'));    }

    public function show(User $user) {
        $agenda = $user->agenda()
        ->with(['presensi'])->latest()->get();


        if (Auth::user()->jabatan == 'Admin') {
           return view('admin.agenda.show', compact('user', 'agenda'));
        } elseif (Auth::user()->jabatan == 'Pimpinan') {
            return view('pimpinan.agenda.show', compact('user', 'agenda'));
        } else {
            abort(403, 'Akses ditolak.');
        }
    }

    public function uploadKehadiran(Request $request)
    {
        $request->validate([
            'agenda_id' => 'required|exists:agendas,id',
            'file_kehadiran' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
    
        $agendaId = $request->agenda_id;
        $userId = $request->user_id;
        $pimpinan = $request->pimpinan;
    
        // Upload file
        $file = $request->file('file_kehadiran');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('file/kehadiran', $filename, 'public');
    
        // Cek apakah user sudah pernah upload sebelumnya
        $existing = DB::table('transkrip_presensis')
            ->where('agenda_id', $agendaId)
            ->where('user_id', $userId)
            ->first();
    
        if ($existing) {
            // Update file jika sudah ada
            DB::table('transkrip_presensis')
                ->where('id', $existing->id)
                ->update([
                    'file_kehadiran' => $path,
                    'updated_at' => now(),
                ]);
        } else {
            // Simpan baru
            DB::table('transkrip_presensis')->insert([
                'agenda_id' => $agendaId,
                'user_id' => $userId,
                'pimpinan' => $pimpinan,
                'hadir' => true,
                'file_kehadiran' => $path,
                'created_at' => now(),
            ]);
        }
    
        return redirect()->back()->with('success', 'Bukti kehadiran berhasil diupload.');
    }


    public function create() {
    $user = Auth::user();
    
    $data = [
        'title' => 'Tambah Agenda',
        'user' => User::where('jabatan', 'pimpinan')->get(),
    ];

    if ($user->jabatan == 'Admin') {
        $data['menuAdminAgenda'] = 'active';
        return view('admin.agenda.create', $data);
    } elseif ($user->jabatan == 'Pimpinan') {
        $data['menuPimpinanAgenda'] = 'active';
        return view('pimpinan.agenda.create', $data);
    }

    abort(403, 'Akses ditolak.');
}

    public function store(Request $request) {
        $validated = $request->validate([
            'judul'             => 'required|string',
            'tanggal_mulai'     => 'required|date',
            'prioritas'         => 'required|string',
            'kategori'          => 'required|string',
            'tempat'            => 'required|string',
            'deskripsi'         => 'required|string',
            'file'              => 'nullable|file|mimes:pdf,doc,docx,xlsx,jpg,png|max:2048',
        ], [
            'judul.required'            => 'Judul tidak boleh kosong',
            'tanggal_mulai.required'    => 'Tanggal Mulai tidak boleh kosong',
            'prioritas.required'        => 'Prioritas tidak boleh kosong',
            'kategori.required'         => 'Kategori tidak boleh kosong',
            'tempat.required'           => 'Tempat tidak boleh kosong',
            
        ]);
        $agenda = new Agenda();
        $agenda->user_id          = $request->user_id ?? auth()->id();
        $agenda->judul            = $request->judul;
        $agenda->tanggal_mulai    = $request->tanggal_mulai;
        $agenda->prioritas        = $request->prioritas;
        $agenda->kategori         = $request->kategori;
        $agenda->tempat           = $request->tempat;
        $agenda->deskripsi        = $request->deskripsi;


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('file/agenda'), $filename);
            $agenda->file = 'file/agenda/' . $filename;
        }
    
        $agenda->save();

        $user = User::findOrFail($agenda->user_id);
        $user->is_tugas = true;
        $user->save();

        return redirect()->route('agenda')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id) {
        $agenda = Agenda::with('user')->findOrFail($id);
        return view('admin.agenda.update', [
            'title' => 'Edit Agenda',
            'menuAdminAgenda' => 'active',
            'agenda' => Agenda::with('user')->findOrFail($id),
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'judul' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'prioritas' => 'required|string',
            'kategori' => 'required|string',
            'tempat' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->only([
            'judul', 'tanggal_mulai',
            'prioritas', 'kategori', 'tempat', 'deskripsi'
        ]));

        return redirect()->route('agenda')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy($id) {
        $agenda = Agenda::findOrFail($id);
        $user = User::find($agenda->user_id);
        $agenda->delete();

        if ($user) {
            $user->is_tugas = false;
            $user->save();
        }

        return redirect()->route('agenda')->with('success', 'Data Berhasil Dihapus');
    }

    public function excel() {
        $filename = now()->format('d-m-y H.i.s');
        return Excel::download(new AgendaExport, 'DataAgenda_' . $filename . '.xlsx');
    }

    public function pdf() {
        $filename = now()->format('d-m-y H.i.s');
        $data = [
            'agenda' => Agenda::get(),
            'tanggal' => now()->format('d-m-Y'),
            'jam' => now()->format('H.i.s'),
        ];
        $pdf = Pdf::loadView('admin.agenda.pdf', $data);
        return $pdf->stream('DataAgenda_' . $filename . '.pdf');
    }

    public function delegate(Request $request)
{
    $request->validate([
        'agenda_id' => 'required|exists:agendas,id',
        'user_id' => 'required|exists:users,id',
    ]);

    $agenda = Agenda::findOrFail($request->agenda_id);
    $agenda->user_id = $request->user_id;
    $agenda->is_delegated = true; // Tandai agenda sebagai didelegasikan
    $agenda->save();

    return redirect()->route('agenda')->with('success', 'Agenda berhasil didelegasikan.');
}

}
