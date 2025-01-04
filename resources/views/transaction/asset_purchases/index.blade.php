@extends('layouts.app')

@section('title', 'Daftar Pembelian Aset')

@section('page_title', 'Daftar Pembelian Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')

    @include('partials.table', [
        'createRoute' => route('asset_purchases.create'),
        'editRoute' => null,
        'showRoute' => 'asset_purchases.show',
        'deleteRoute' => null,
        'columns' => ['Tanggal', 'Kode', 'Nama Aset', 'Jumlah', 'Total'],
        'fields' => ['formatted_purchase_date', 'purchase_code', 'asset.name', 'quantity', 'formatted_total_cost'],
        'items' => $assetPurchases,
    ])

    <div class="d-flex justify-content-center mt-3">
        {{ $assetPurchases->links('pagination::bootstrap-4') }}
    </div>
@endsection
