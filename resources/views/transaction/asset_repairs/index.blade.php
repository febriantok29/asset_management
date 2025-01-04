@extends('layouts.app')

@section('title', 'Daftar Perbaikan Aset')

@section('page_title', 'Daftar Perbaikan Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')

    @include('partials.table', [
        'createRoute' => route('asset_repairs.create'),
        'editRoute' => null,
        'showRoute' => 'asset_repairs.show',
        'deleteRoute' => null,
        'columns' => ['Kode Perbaikan', 'Nama Teknisi', 'Tanggal Perbaikan', 'Biaya', 'Status'],
        'fields' => ['repair_code', 'technician_name', 'repair_date', 'formatted_cost', 'status'],
        'items' => $assetRepairs,
    ])

@endsection