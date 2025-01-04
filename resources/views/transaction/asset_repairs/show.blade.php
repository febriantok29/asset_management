@extends('layouts.app')

@section('title', 'Detail Perbaikan Aset')

@section('page_title', 'Detail Perbaikan Aset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('asset_repairs.index') }}">Daftar Perbaikan Aset</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Kode Perbaikan:</h5>
                    <p class="card-text">{{ $assetRepair->repair_code }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">Nama Teknisi:</h5>
                    <p class="card-text">{{ $assetRepair->technician_name }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Tanggal Perbaikan:</h5>
                    <p class="card-text">{{ $assetRepair->repair_date->format('d-m-Y') }}</p>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title">Biaya:</h5>
                    <p class="card-text">{{ $assetRepair->formatted_cost }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Status:</h5>
                    <p class="card-text">{{ $assetRepair->status }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <h5 class="card-title">Deskripsi Masalah:</h5>
                    <textarea class="form-control" rows="10" readonly>{{ $assetRepair->issue_description }}</textarea>
                </div>
            </div>
            <a href="{{ route('asset_repairs.index') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
