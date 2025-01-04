@extends('layouts.app')

@section('title', 'Detail Perawatan Asset')

@section('page_title', 'Detail Perawatan Asset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asset_maintenances.index') }}">Daftar Perawatan Asset</a></li>
    <li class="breadcrumb-item active">Detail Perawatan Asset</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Detail Perawatan Asset</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Perawatan</th>
                    <td>{{ $assetMaintenance->maintenance_code }}</td>
                </tr>
                <tr>
                    <th>Asset</th>
                    <td>{{ $assetMaintenance->asset->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal Perawatan</th>
                    <td>{{ $assetMaintenance->maintenance_date->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <th>Masalah</th>
                    <td>{{ $assetMaintenance->issue }}</td>
                </tr>
                <tr>
                    <th>Teknisi</th>
                    <td>{{ $assetMaintenance->technician }}</td>
                </tr>
                <tr>
                    <th>Biaya</th>
                    <td>{{ $assetMaintenance->cost }}</td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('asset_maintenances.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
