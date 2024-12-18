@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Aset</h1>
        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Nama Aset</label>
                <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="code">Kode Aset</label>
                <input type="text" name="code" class="form-control" value="{{ $asset->code }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="supplier_id">Pemasok</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">Pilih Pemasok</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $asset->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_price">Harga Pembelian</label>
                <input type="number" step="0.01" name="purchase_price" class="form-control"
                    value="{{ $asset->purchase_price }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_date">Tanggal Pembelian</label>
                <input type="date" name="purchase_date" class="form-control" value="{{ $asset->purchase_date }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $asset->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
