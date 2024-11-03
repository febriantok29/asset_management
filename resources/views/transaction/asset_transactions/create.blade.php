@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Transaksi Aset Baru</h1>
        <form action="{{ route('asset_transactions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="asset_id" class="form-label">Aset</label>
                <select name="asset_id" id="asset_id" class="form-control" required>
                    <option value="">-- Pilih Aset --</option>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="transaction_type" class="form-label">Tipe Transaksi</label>
                <input type="text" name="transaction_type" class="form-control" id="transaction_type" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" id="quantity" required min="1">
            </div>
            <div class="mb-3">
                <label for="transaction_date">Tanggal Transaksi</label>
                <input type="date" id="transaction_date" name="transaction_date" class="form-control"
                    max="{{ date('Y-m-d') }}"
                    value="{{ old('transaction_date', isset($transaction) ? $transaction->transaction_date : '') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
