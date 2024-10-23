@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Supplier Baru</h1>
        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Supplier</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Nomor Kontak</label>
                <input type="text" name="contact_number" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
