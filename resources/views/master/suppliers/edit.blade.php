@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Supplier</h1>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Supplier</label>
                <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Nomor Kontak</label>
                <input type="text" name="contact_number" class="form-control" value="{{ $supplier->contact_number }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="address" class="form-control">{{ $supplier->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
