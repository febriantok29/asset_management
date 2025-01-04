@extends('layouts.app')

@section('title', 'Detail Aset')

@section('content')
    <div class="container mt-4">
        <h1>Detail Aset</h1>
        <div class="card">
            <div class="card-header">
                <h3>{{ $asset->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="name">Nama Aset</label>
                            <input type="text" class="form-control" value="{{ $asset->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="code">Kode Aset</label>
                            <input type="text" class="form-control" value="{{ $asset->code }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="category">Kategori</label>
                            <input type="text" class="form-control" value="{{ $asset->category->name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vendor">Vendor</label>
                            <input type="text" class="form-control" value="{{ $asset->vendor->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="stock">Jumlah</label>
                    <input type="number" class="form-control" value="{{ $asset->stock }}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" disabled>{{ $asset->description }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
@endsection
