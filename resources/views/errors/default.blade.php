@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <img src="https://via.placeholder.com/150/FF0000/FFFFFF?text=Error" alt="General Error" class="mb-4">
        <h1 class="display-4">Oops! Terjadi Kesalahan</h1>
        <p class="lead">
            {{ $message ?? 'Maaf, terjadi kesalahan tak terduga. Silakan coba lagi atau hubungi administrator.' }}</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
