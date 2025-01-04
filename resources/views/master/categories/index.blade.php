@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('page_title', 'Daftar Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
    <div class="mb-3">
        <form action="{{ route('categories.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Cari Kategori" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
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
@endsection
