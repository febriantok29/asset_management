@extends('layouts.app')

@section('title', 'Detail Transfer Aset')

@section('page_title', 'Detail Transfer Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Transfer</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('asset_transfers.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="transfer_code" class="form-label">Kode Transfer</label>
                    <input type="text" id="transfer_code" class="form-control"
                        value="{{ $assetTransfer->transfer_code }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="asset_name" class="form-label">Aset</label>
                    <input type="text" id="asset_name" class="form-control" value="{{ $assetTransfer->asset->name }}"
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="from_location" class="form-label">Dari Lokasi</label>
                    <input type="text" id="from_location" class="form-control"
                        value="{{ $assetTransfer->fromLocation->name ?? 'N/A' }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="to_location" class="form-label">Ke Lokasi</label>
                    <input type="text" id="to_location" class="form-control"
                        value="{{ $assetTransfer->toLocation->name }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="text" id="quantity" class="form-control" value="{{ $assetTransfer->quantity }}"
                        disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="transfer_date" class="form-label">Tanggal</label>
                    <input type="text" id="transfer_date" class="form-control"
                        value="{{ \Carbon\Carbon::parse($assetTransfer->transfer_date)->translatedFormat('l, d F Y') }}"
                        disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" class="form-control" rows="3" disabled>{{ $assetTransfer->description ?? 'Tidak ada deskripsi.' }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
