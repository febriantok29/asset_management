{{-- filepath: /Users/febriantok29/Data/Academics/Semester_5/6. Pemrograman Web Lanjut/asset_management/resources/views/reports/vendor_purchases/vendor_purchases.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Pembelian Vendor</h1>
        <div class="mb-3">
            <a href="{{ route('report.vendor_purchases.pdf') }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('report.vendor_purchases.excel') }}" class="btn btn-success">Unduh Excel</a>
        </div>
        @include('partials.table', [
            'columns' => ['ID', 'Nama Vendor', 'Total Pembelian', 'Pembelian Terakhir'],
            'fields' => ['id', 'name', 'purchases_count', 'last_purchase_date'],
            'items' => $data,
        ])
    </div>
@endsection
