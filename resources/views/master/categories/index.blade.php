@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('page_title', 'Daftar Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
<div class="mb-3">
        @include('partials.search', ['route' => route('categories.index')])
    </div>
    @include('partials.table', [
        'createRoute' => route('categories.create'),
        'editRoute' => 'categories.edit',
        'showRoute' => 'categories.show',
        'deleteRoute' => 'categories.destroy',
        'columns' => ['Kode', 'Nama Kategori', 'Deskripsi'],
        'fields' => ['code', 'name', 'description'],
        'items' => $categories,
    ])
    
    @include('partials.pagination', ['paginator' => $categories])

@endsection
