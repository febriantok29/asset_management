@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <img src="https://via.placeholder.com/150/FF4500/000000?text=500+Error" alt="500 Error" class="mb-4">
        <h1 class="display-4">500 - Terjadi Kesalahan Server</h1>
        <p class="lead">Maaf, terjadi kesalahan di server kami. Silakan coba lagi beberapa saat atau hubungi administrator.
        </p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
