@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-table mr-2"></i>
    Transkrip Presensi:
    {{$user->nama }}
</h1>       
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Agenda</th>
                        <th>Waktu</th>
                        <th>Kategori</th>
                        <th>Tempat</th>
                        <th>Kehadiran</th>
                        <th><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agenda as $index => $item)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('Y-m-d H:i') }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->tempat }}</td>
                        <td>{{ $item->presensi?->hadir ? 'Hadir' : 'Tidak' }}</td>

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

@endsection
