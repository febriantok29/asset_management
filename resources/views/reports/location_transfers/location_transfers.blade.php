{{-- filepath: /Users/febriantok29/Data/Academics/Semester_5/6. Pemrograman Web Lanjut/asset_management/resources/views/reports/location_transfers/location_transfers.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan Transfer Lokasi</h1>
        <div class="mb-3">
            {{-- Unduh PDF and Excel --}}
            <a href="{{ route('report.location_transfers.pdf') }}" class="btn btn-primary">Unduh PDF</a>
            <a href="{{ route('report.location_transfers.excel') }}" class="btn btn-success">Unduh Excel</a>
        </div>
        @include('partials.table', [
            'columns' => [
                'Kode Transfer',
                'Nama Aset',
                'Lokasi Asal',
                'Lokasi Tujuan',
                'Jumlah',
                'Tanggal Transfer',
                'Keterangan',
            ],
            'fields' => [
                'transfer_code',
                'asset.name',
                'fromLocation.name',
                'toLocation.name',
                'quantity',
                'formatted_transfer_date',
                'description',
            ],
            'items' => $data,
        ])
    </div>
@endsection
