@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Transaksi Aset</h1>
        <a href="{{ route('asset_transactions.create') }}" class="btn btn-primary mb-3">Tambah Transaksi Aset</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Aset</th>
                    <th>Tipe Transaksi</th>
                    <th>Jumlah</th>
                    <th>Tanggal Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->code }}</td>
                        <td>{{ $transaction->asset->name }}</td>
                        <td>{{ $transaction->transaction_type }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>{{ $transaction->transaction_date->translatedFormat('l, d F Y') }}</td>
                        <td>
                            <a href="{{ route('asset_transactions.edit', $transaction->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('asset_transactions.destroy', $transaction->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
