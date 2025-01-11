@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Ringkasan Aset</h1>
    <div class="mb-3">
        <a href="{{ route('report.assets_summary.pdf') }}" class="btn btn-primary">Unduh PDF</a>
        <a href="{{ route('report.assets_summary.excel') }}" class="btn btn-success">Unduh Excel</a>
    </div>
    @include('partials.table', [
        'columns' => ['No', 'Nama', 'Kategori','Stok', 'Lokasi', 'Tanggal Pembelian Terakhir', 'Total Biaya'],
        'fields' => [
            'id',
            'name',
            'category.name',
            'stock',
            'location.name',
            'latestPurchase.formatted_purchase_date',
            'latestPurchase.formatted_total_cost',
        ],
        'items' => $data,
    ])
</div>
@endsection
