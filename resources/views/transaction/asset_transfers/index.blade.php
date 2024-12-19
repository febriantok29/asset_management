@extends('layouts.app')

@section('title', 'Daftar Transfer Aset')

@section('page_title', 'Daftar Transfer Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Transfer Aset</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('asset_transfers.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah
                Transfer</a>
        </div>
        <div class="card-body">
            @if ($assetTransfers->count())
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Transfer</th>
                            <th>Aset</th>
                            <th>Dari Lokasi</th>
                            <th>Ke Lokasi</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assetTransfers as $transfer)
                            <tr>
                                <td>{{ $transfer->transfer_code }}</td>
                                <td>{{ $transfer->asset->name }}</td>
                                <td>{{ $transfer->fromLocation->name ?? 'N/A' }}</td>
                                <td>{{ $transfer->toLocation->name }}</td>
                                <td>{{ $transfer->quantity }}</td>
                                <td>{{ \Carbon\Carbon::parse($transfer->created_at)->translatedFormat('l, d F Y H:i') }}
                                </td>
                                <td>
                                    <a href="{{ route('asset_transfers.show', $transfer->id) }}"
                                        class="btn btn-info btn-sm">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Belum ada data transfer aset.</p>
            @endif
        </div>
    </div>
@endsection
