@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $title }}</h2>
    <a href="{{ route('ruangan.create') }}" class="btn btn-primary mb-3">+ Tambah Ruangan</a>

    <div class="row">
        @forelse ($ruangans as $ruangan)
            <div class="col-md-4 mb-3">
                <a href="{{ route('ruangan.show', $ruangan->id) }}" class="text-decoration-none">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="bi bi-house-door" style="font-size: 2rem;"></i>
                            </div>
                            <div>
                                <small class="text-muted">RUANGAN</small>
                                <h5>{{ $ruangan->nama }}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p>Tidak ada data ruangan.</p>
        @endforelse
    </div>
</div>
@endsection
