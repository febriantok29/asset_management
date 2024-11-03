@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Lokasi Aset</h1>
        <form action="{{ route('asset_locations.update', $assetLocation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Nama Lokasi</label>
                <input type="text" name="name" class="form-control" value="{{ $assetLocation->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="code">Kode Lokasi</label>
                <input type="text" name="code" class="form-control" value="{{ $assetLocation->code }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $assetLocation->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('asset_locations.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
