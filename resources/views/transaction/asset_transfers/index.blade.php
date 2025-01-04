@extends('layouts.app')

@section('title', 'Daftar Transfer Aset')

@section('page_title', 'Daftar Transfer Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Transfer Aset</li>
@endsection

@section('content')
    @include('partials.table', [
        'createRoute' => route('asset_transfers.create'),
        'editRoute' => null,
        'showRoute' => 'asset_transfers.show',
        'deleteRoute' => null,
        'columns' => ['Kode Transfer', 'Aset', 'Dari Lokasi', 'Ke Lokasi', 'Jumlah', 'Tanggal'],
        'fields' => ['transfer_code', 'asset.name', 'fromLocation.name', 'toLocation.name', 'quantity', 'formatted_transfer_date'],
        'items' => $assetTransfers,
    ])

    <div class="d-flex justify-content-center mt-3">
        {{ $assetTransfers->links('pagination::bootstrap-4') }}
    </div>
@endsection
