@extends('layouts.app')

@section('title', 'Detail Pembelian Aset')

@section('page_title', 'Detail Pembelian Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Detail Pembelian</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('asset_purchases.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_code" class="form-label">Kode Pembelian</label>
                    <input type="text" id="purchase_code" class="form-control" value="{{ $assetPurchase->purchase_code }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="asset_name" class="form-label">Aset</label>
                    <input type="text" id="asset_name" class="form-control" value="{{ $assetPurchase->asset->name }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="vendor_name" class="form-label">Vendor</label>
                    <input type="text" id="vendor_name" class="form-control" value="{{ $assetPurchase->vendor->name }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="text" id="quantity" class="form-control" value="{{ $assetPurchase->quantity }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="purchase_date" class="form-label">Tanggal</label>
                    <input type="text" id="purchase_date" class="form-control" value="{{ $assetPurchase->formatted_purchase_date }}" disabled>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="total_cost" class="form-label">Total Biaya</label>
                    <input type="text" id="total_cost" class="form-control" value="{{ $assetPurchase->formatted_total_cost }}" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea id="description" class="form-control" rows="3" disabled>{{ $assetPurchase->description ?? 'Tidak ada deskripsi.' }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
