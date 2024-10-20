@extends('layouts.app')

@section('content')
    <div class="container mt-5 text-center">
        <img src="https://via.placeholder.com/200x200/FFCCCB/000000?text=404" alt="404 Error" class="mb-4"
            style="max-width: 100%; height: auto;">
        <h1 class="display-4">Oops! Halaman Tidak Ditemukan</h1>
        <p class="lead">Sepertinya halaman yang Anda cari tidak ada atau mungkin sudah dihapus.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Kembali ke Halaman Sebelumnya</a>
    </div>
@endsection
