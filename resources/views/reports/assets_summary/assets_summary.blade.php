@@ -1,24 +0,0 @@
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Ringkasan Aset</h1>
        <div class="mb-3">
            <a href="{{ route('report.assets_summary.pdf') }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('report.assets_summary.excel') }}" class="btn btn-success">Unduh Excel</a>
        </div>
        @include('partials.table', [
            'columns' => ['ID', 'Nama', 'Kategori', 'Lokasi', 'Vendor', 'Tanggal Pembelian', 'Biaya'],
            'fields' => [
                'id',
                'name',
                'category.name',
                'latest_transfer_location_name',
                'vendor.name',
                'latestPurchase.formatted_purchase_date',
                'latestPurchase.formatted_total_cost',
            ],
            'items' => $data,
        ])
    </div>
@endsection
