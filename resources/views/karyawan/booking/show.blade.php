@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Jadwal Booking - {{ $ruangan->nama }}</h2>

    @forelse ($bookings as $booking)
        <div class="card mb-2">
            <div class="card-body">
                <strong>{{ $booking->nama_peminjam }}</strong> - {{ $booking->tanggal }}<br>
                Waktu: {{ $booking->waktu_mulai }} - {{ $booking->waktu_selesai }}<br>
                Keperluan: {{ $booking->keperluan }}
            </div>
        </div>
    @empty
        <p>Belum ada booking.</p>
    @endforelse

    <a href="{{ route('booking.create', $ruangan->id) }}" class="btn btn-primary mt-3">Lanjut Booking</a>
</div>
@endsection
