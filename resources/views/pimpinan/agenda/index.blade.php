@extends('layouts/app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-tasks mr-2"></i>
        {{ $title }}
    </h1>  

    <div class="row">
        @foreach ($user as $item)
            <div class="col-md-4 mb-3">
                <a href="{{ route('agenda.show', $item->id) }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm border-left-success">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted">PIMPINAN</small>
                                <p class="mt-1 mb-0">{{ $item->nama }}</p>
                            </div>
                            <div>
                                <i class="fas fa-user fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

