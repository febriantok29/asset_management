<!-- index view for master/asset_locations -->

@extends('layouts.app')

@section('title', 'Daftar Lokasi Aset')

@section('page_title', 'Daftar Lokasi Aset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Lokasi Aset</li>
@endsection


@section('content')

    <div class="mb-3">
        @include('partials.search', ['route' => route('asset_locations.index')])
    </div>
    <div class="container mt-4">
        @include('partials.table', [
            'createRoute' => route('asset_locations.create'),
            'editRoute' => 'asset_locations.edit',
            'showRoute' => 'asset_locations.show',
            'deleteRoute' => 'asset_locations.destroy',
            'columns' => ['Kode', 'Nama Lokasi', 'Alamat'],
            'fields' => ['code', 'name', 'address'],
            'items' => $locations,
        ])
    </div>
    @include('partials.pagination', ['paginator' => $locations])
@endsection
