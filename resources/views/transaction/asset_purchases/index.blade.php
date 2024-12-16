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
        'deleteRoute' => 'asset_purchases.destroy',
        'columns' => ['#', 'Tanggal', 'Kode', 'Nama Aset', 'Jumlah', 'Harga', 'Total'],
        'fields' => ['date', 'code', 'name', 'quantity', 'price', 'total'],
        'items' => $assetPurchases,
    ])
@endsection
