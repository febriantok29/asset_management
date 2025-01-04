@extends('layouts.app')

@section('title', 'Detail Vendor')

@section('page_title', 'Detail Vendor')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">Detail Vendor</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Kode Vendor:</strong></div>
                    <div class="col-md-9">{{ $vendor->code }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Nama Vendor:</strong></div>
                    <div class="col-md-9">{{ $vendor->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Email:</strong></div>
                    <div class="col-md-9">{{ $vendor->email }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Telepon:</strong></div>
                    <div class="col-md-9">{{ $vendor->phone }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Alamat:</strong></div>
                    <div class="col-md-9">{{ $vendor->address }}</div>
                </div>
                <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
