@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-table mr-2"></i>
    Jadwal Kegiatan dan Rapat:
    {{$user->nama }}
</h1>       
<div class="card">
    <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
        <div class="mb-1 mr-2">
            <a href="{{ route('agendaCreate') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus mr-2"></i> Tambah Data
            </a>
        </div> 
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Agenda</th>
                        <th>Waktu</th>
                        <th>Prioritas</th>
                        <th>Kategori</th>
                        <th>Tempat</th>
                        <th>Deskripsi</th>
                        <th>File</th>
                        <th>Kehadiran</th>
                        <th><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agenda as $index => $item)
                    <tr class="text-center {{ $item->is_delegated ? 'bg-gray-200 text-dark' : '' }}">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->prioritas }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td>
                            @if($item->file)
                                <a href="{{ asset($item->file) }}" target="_blank">Lihat File</a>
                            @else
                                No File
                            @endif
                        </td>
                        <td>
                            @if($item->presensi?->hadir)
                                <span class="badge badge-success">Hadir</span><br>
                                <a href="{{ asset('storage/' . $item->presensi->file_kehadiran) }}" target="_blank" class="btn btn-sm btn-info mt-1">
                                    Lihat Bukti
                                </a>
                                <form action="{{ route('agendaKehadiran') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="agenda_id" value="{{ $item->id }}">
                                    <input type="file" name="file_kehadiran" class="form-control-file mb-1" required>
                                    <button type="submit" class="btn btn-sm btn-warning">Ganti Bukti</button>
                                </form>
                            @else
                                <span class="badge badge-danger">Belum Hadir</span>
                                <form action="{{ route('agendaKehadiran') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="agenda_id" value="{{ $item->id }}">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="pimpinan" value="{{ $user->nama }}">
                                    <input type="file" name="file_kehadiran" class="form-control-file mb-1" required>
                                    <button type="submit" class="btn btn-sm btn-success">Upload Bukti</button>
                                </form>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('agendaEdit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalHapus{{ $item->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @include('admin/agenda/modal')
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center py-4">Tidak ada agenda.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Delegasi Agenda ke Pimpinan Lain --}}
<h2 class="text-xl font-semibold mb-3">Delegasikan Agenda</h2>

<form method="POST" action="{{ route('agendaDelegate') }}">
    @csrf
    <div class="flex flex-col md:flex-row items-center gap-4">
        <select name="agenda_id" class="border px-3 py-2 rounded w-full md:w-1/3" required>
            <option value="">-- Pilih Agenda --</option>
            @foreach($agenda as $item)
                @if(!$item->presensi)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                @endif
            @endforeach
        </select>

        <select name="user_id" class="border px-3 py-2 rounded w-full md:w-1/3" required>
            <option value="">-- Pilih Pimpinan Tujuan --</option>
            @foreach(App\Models\User::where('id', '!=', $user->id)->where('jabatan', 'Pimpinan')->get() as $pimpinan)
                <option value="{{ $pimpinan->id }}">{{ $pimpinan->nama }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary text-white px-4 py-2 rounded hover:bg-blue-600">
            Delegasikan
        </button>
    </div>
</form>

<a href="{{ route('agenda') }}" class="block mt-6 text-blue-600 hover:underline">← Kembali ke daftar pimpinan</a>
@endsection
