@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>

    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}">
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <!-- Password Baru -->
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control">
        </div>

        <!-- Konfirmasi Password Baru -->
        <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group">
            <label for="foto">Foto Profil</label><br>
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" width="100" class="mb-2 rounded">
            @endif
            <input type="file" name="foto" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('profil') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
