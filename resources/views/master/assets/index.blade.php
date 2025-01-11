<!-- index view for master/assets -->

@extends('layouts.app')

@section('title', 'Daftar Aset')

@section('page_title', 'Daftar Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')

    <div class="mb-3">
        @include('partials.search', ['route' => route('assets.index')])
    </div>
    <div class="container mt-4">
        @include('partials.table', [
            'createRoute' => route('assets.create'),
            'editRoute' => 'assets.edit',
            'showRoute' => 'assets.show',
            'deleteRoute' => 'assets.destroy',
            'columns' => ['Kode', 'Nama Aset', 'Kategori', 'lokasi', 'Jumlah', 'Deskripsi'],
            'fields' => ['code', 'name', 'category.name', 'location.name', 'stock', 'description'],
            'items' => $assets,
        ])
    </div>
    @include('partials.pagination', ['paginator' => $assets])
@endsection
