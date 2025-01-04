@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Lokasi Aset</h1>
        <form action="{{ route('asset_locations.update', $assetLocation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group mb-3">
                        <label for="name">Nama Lokasi</label>
                        <input type="text" name="name" class="form-control" value="{{ $assetLocation->name }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="code">Kode Lokasi</label>
                        <input type="text" name="code" class="form-control" value="{{ $assetLocation->code }}"
                            required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" class="form-control">{{ $assetLocation->address }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('asset_locations.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
