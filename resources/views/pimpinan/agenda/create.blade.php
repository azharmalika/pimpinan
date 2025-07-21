@extends('layouts/app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-calendar-plus mr-2"></i>
    Tambah Agenda Baru - 
    {{ auth()->user()->nama }}
</h1>

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('agendaStore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Pilih Pimpinan -->
            <div class="form-group">
                <label for="user_id">Pilih Pimpinan</label>
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <select class="form-control" disabled>
                        <option>{{ auth()->user()->nama }}</option>
                    </select>
            </div>

            <div class="form-group mb-3">
                <label for="judul">Judul Agenda</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal_mulai">Tanggal & Waktu Mulai</label>
                    <input type="datetime-local" name="tanggal_mulai" class="form-control" required>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="prioritas">Prioritas</label>
                <select name="prioritas" class="form-control" required>
                    <option value="">-- Pilih Prioritas --</option>
                    <option value="Tinggi">Tinggi</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Rendah">Rendah</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="kategori">Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Rapat">Rapat</option>
                    <option value="Kegiatan">Kegiatan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="tempat">Tempat</label>
                <input type="text" name="tempat" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="file">Upload File (opsional)</label>
                <input type="file" name="file" class="form-control-file">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('agenda') }}" class="btn btn-secondary">
                    ← Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i>Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
