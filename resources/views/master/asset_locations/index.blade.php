<!-- index view for master/asset_locations -->

@extends('layouts.app')

@section('title', 'Daftar Lokasi Aset')

@section('page_title', 'Daftar Lokasi Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    @include('partials.table', [
        'createRoute' => route('asset_locations.create'),
        'editRoute' => 'asset_locations.edit',
        'showRoute' => 'asset_locations.show',
        'deleteRoute' => 'asset_locations.destroy',
        'columns' => ['Kode', 'Nama Lokasi', 'Alamat'],
        'fields' => ['code', 'name', 'address'],
        'items' => $locations,
    ])
@endsection
