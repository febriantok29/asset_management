@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Transaksi Aset</h1>
        <form action="{{ route('asset_transactions.update', $transaction->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="asset_id" class="form-label">Aset</label>
                <select name="asset_id" id="asset_id" class="form-control" required>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->id }}" {{ $asset->id == $transaction->asset_id ? 'selected' : '' }}>
                            {{ $asset->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="transaction_type" class="form-label">Tipe Transaksi</label>
                <input type="text" name="transaction_type" class="form-control" id="transaction_type"
                    value="{{ $transaction->transaction_type }}" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" name="quantity" class="form-control" id="quantity"
                    value="{{ $transaction->quantity }}" required min="1">
            </div>
            <div class="mb-3">
                <label for="transaction_date" class="form-label">Tanggal Transaksi</label>
                <input type="date" name="transaction_date" class="form-control" id="transaction_date"
                    value="{{ $transaction->transaction_date->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label for="notes" class="form-label">Catatan</label>
                <textarea name="notes" id="notes" class="form-control" rows="3">{{ $transaction->notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
@endsection
