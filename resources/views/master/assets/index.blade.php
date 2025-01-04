<!-- index view for master/assets -->

@extends('layouts.app')

@section('title', 'Daftar Aset')

@section('page_title', 'Daftar Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container mt-4">
        @include('partials.table', [
            'createRoute' => route('assets.create'),
            'editRoute' => 'assets.edit',
            'showRoute' => 'assets.show',
            'deleteRoute' => 'assets.destroy',
            'columns' => ['Kode', 'Nama Aset', 'Kategori', 'Vendor', 'Jumlah', 'Deskripsi'],
            'fields' => ['code', 'name', 'category.name', 'vendor.name', 'stock', 'description'],
            'items' => $assets,
        ])
    </div>
@endsection
