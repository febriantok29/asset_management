@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <h1 class="display-4">Terjadi Kesalahan Pada Query</h1>
        <p class="lead">Maaf, terjadi kesalahan saat mengakses data di server kami.</p>

        @if (env('APP_DEBUG'))
            <div class="alert alert-danger mt-4">
                <h4>Detail Error:</h4>
                <p>{{ $errorMessage }}</p>
            </div>
        @endif

        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
