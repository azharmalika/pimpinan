@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Booking - {{ $ruangan->nama }}</h2>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">

        <div class="mb-3">
            <label>Nama Peminjam</label>
            <input type="text" name="nama_peminjam" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Waktu Mulai</label>
            <input type="time" name="waktu_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Waktu Selesai</label>
            <input type="time" name="waktu_selesai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keperluan</label>
            <textarea name="keperluan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Booking</button>
    </form>
</div>
@endsection
