@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Detail Lokasi Aset</h1>
        <div class="row">
            <div class="col-md-9">
                <div class="form-group mb-3">
                    <label for="name">Nama Lokasi</label>
                    <input type="text" id="name" class="form-control" value="{{ $assetLocation->name }}" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-3">
                    <label for="code">Kode Lokasi</label>
                    <input type="text" id="code" class="form-control" value="{{ $assetLocation->code }}" readonly>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group mb-3">
                    <label for="address">Alamat</label>
                    <textarea id="address" class="form-control" readonly>{{ $assetLocation->address }}</textarea>
                </div>
            </div>
        </div>
        <a href="{{ route('asset_locations.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
