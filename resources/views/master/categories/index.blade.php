@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('page_title', 'Daftar Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    @include('partials.table', [
        'createRoute' => route('categories.create'),
        'editRoute' => 'categories.edit',
        'showRoute' => 'categories.show',
        'deleteRoute' => 'categories.destroy',
        'columns' => ['#', 'Kode', 'Nama Kategori', 'Deskripsi'],
        'fields' => ['code', 'name', 'description'],
        'items' => $categories,
    ])
@endsection
