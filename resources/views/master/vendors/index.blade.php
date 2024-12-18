<!-- index view for master/vendors -->

@extends('layouts.app')

@section('title', 'Daftar Vendor')

@section('page_title', 'Daftar Vendor')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    @include('partials.table', [
        'createRoute' => route('vendors.create'),
        'editRoute' => 'vendors.edit',
        'showRoute' => 'vendors.show',
        'deleteRoute' => 'vendors.destroy',
        'columns' => ['Kode', 'Nama Vendor', 'Email', 'Telepon', 'Alamat'],
        'fields' => ['code', 'name', 'email', 'phone', 'address'],
        'items' => $vendors,
    ])
@endsection
