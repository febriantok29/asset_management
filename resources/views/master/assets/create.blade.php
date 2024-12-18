@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Aset Baru</h1>
        <form action="{{ route('assets.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Nama Aset</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="code">Kode Aset</label>
                <input type="text" name="code" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="supplier_id">Pemasok</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">Pilih Pemasok</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_price">Harga Pembelian</label>
                <input type="number" step="0.01" name="purchase_price" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_date">Tanggal Pembelian</label>
                <input type="date" name="purchase_date" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
