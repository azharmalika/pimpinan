@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Profil Saya</h2>
    <img src="{{ asset($user->photo ?? 'uploads/profile/default.png') }}" width="100" class="mb-3 rounded-circle" alt="Foto Profil">
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <a href="{{ route('profil.edit') }}" class="btn btn-primary">Edit Profil</a>
</div>
@endsection