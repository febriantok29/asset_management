<!-- index view for transaction/asset_maintenance -->

@extends('layouts.app')

@section('title', 'Daftar Perawatan Asset')

@section('page_title', 'Daftar Perawatan Asset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Perawatan Asset</li>
@endsection

@section('content')
    @include('partials.table', [
        'createRoute' => route('asset_maintenances.create'),
        'columns' => ['Kode Perawatan', 'Asset', 'Tanggal Perawatan', 'Teknisi', 'Biaya'],
        'fields' => [
            'maintenance_code',
            'asset.name',
            'formatted_maintenance_date',
            'technician',
            'formatted_cost',
        ],
        'items' => $assetMaintenances,
        'editRoute' => null,
        'showRoute' => 'asset_maintenances.show',
        'deleteRoute' => null,
    ])
@endsection
