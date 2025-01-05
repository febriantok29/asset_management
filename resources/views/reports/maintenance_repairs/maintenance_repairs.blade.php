{{-- filepath: /d:/BimBim/Data/Kuliah/website/asset_management/resources/views/reports/maintenance_repairs/maintenance_repairs.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Perbaikan dan Pemeliharaan</h1>
        <div class="mb-3">
            <a href="{{ route('report.maintenance_repairs.pdf') }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('report.maintenance_repairs.excel') }}" class="btn btn-success">Unduh Excel</a>
        </div>
        @include('partials.table', [
            'columns' => ['Kode Pemeliharaan', 'Nama Aset', 'Tanggal Pemeliharaan', 'Masalah', 'Teknisi', 'Biaya'],
            'fields' => [
                'maintenance_code',
                'asset.name',
                'formatted_maintenance_date',
                'issue',
                'technician',
                'formatted_cost',
            ],
            'items' => $data,
        ])
    </div>
@endsection