@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Aset Baru</h1>
        <form action="{{ route('assets.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group mb-3">
                        <label for="name">Nama Aset</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="code">Kode Aset</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vendor_id">Vendor</label>
                        <select name="vendor_id" class="form-control" required>
                            <option value="">Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="stock">Jumlah</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </form>
    </div>
@endsection
