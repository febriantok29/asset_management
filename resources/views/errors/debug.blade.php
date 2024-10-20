@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="display-4 text-danger">Oops! Terjadi Kesalahan</h1>
        <p class="lead">Pesan Error: <strong>{{ $exception->getMessage() }}</strong></p>
        <p>File: <strong>{{ $exception->getFile() }}</strong></p>
        <p>Baris: <strong>{{ $exception->getLine() }}</strong></p>
        <p>Silakan periksa log untuk detail lebih lanjut.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
