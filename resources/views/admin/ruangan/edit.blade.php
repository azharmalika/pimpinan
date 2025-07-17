@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $title }}</h2>

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Ruangan</label>
            <input type="text" name="nama" id="nama" class="form-control" required value="{{ old('nama', $ruangan->nama) }}">
        </div>

        <div class="mb-3">
            <label for="kapasitas" class="form-label">Kapasitas</label>
            <input type="number" name="kapasitas" id="kapasitas" class="form-control" required value="{{ old('kapasitas', $ruangan->kapasitas) }}">
        </div>

        <div class="mb-3">
            <label for="fasilitas" class="form-label">Fasilitas</label>
            <textarea name="fasilitas" id="fasilitas" class="form-control" rows="3">{{ old('fasilitas', $ruangan->fasilitas) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('ruangan') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
