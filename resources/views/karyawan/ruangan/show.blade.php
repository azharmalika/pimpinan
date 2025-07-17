@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Ruangan</h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $ruangan->nama }}</h4>
            <p><strong>Kapasitas:</strong> {{ $ruangan->kapasitas }} orang</p>
            <p><strong>Fasilitas:</strong> {{ $ruangan->fasilitas ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('ruangan') }}" class="btn btn-secondary mt-3">← Kembali</a>
    @if(Auth::user()->jabatan === 'Admin')
        <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning mt-3">Edit</a>
    @endif
    <a href="{{ route('booking.show', $ruangan->id) }}" class="btn btn-success mt-3">Booking</a>
</div>
@endsection
