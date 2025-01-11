@extends('layouts.app')

@section('title', 'Tambah Pembelian Aset')

@section('page_title', 'Tambah Pembelian Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Tambah Pembelian</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('asset_purchases.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>
                Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('asset_purchases.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="asset_id" class="form-label">Aset</label>
                        <select name="asset_id" id="asset_id" class="form-control @error('asset_id') is-invalid @enderror"
                            required>
                            <option value="">-- Pilih Aset --</option>
                            @foreach ($assets as $asset)
                                <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                    {{ $asset->name }} - lokasi:{{ $asset->location->name }}</option>
                            @endforeach                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="vendor_id" class="form-label">Vendor</label>
                        <select name="vendor_id" id="vendor_id"
                            class="form-control @error('vendor_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Vendor --</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                            required min="1">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="purchase_date" class="form-label">Tanggal Pembelian</label>
                        <input type="date" name="purchase_date" id="purchase_date"
                            class="form-control @error('purchase_date') is-invalid @enderror"
                            value="{{ old('purchase_date', now()->format('Y-m-d')) }}" max="{{ now()->format('Y-m-d') }}"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="total_cost" class="form-label">Total Biaya</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" name="total_cost" id="total_cost"
                                class="form-control @error('total_cost') is-invalid @enderror"
                                value="{{ old('total_cost') }}" oninput="formatRupiah(this)"
                                placeholder="Masukkan total biaya" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            let value = input.value;
            value = value.replace(/[^,\d]/g, '');
            value = new Intl.NumberFormat('id-ID').format(value);
            input.value = value;
        }
    </script>
@endsection
