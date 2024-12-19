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
                    <!-- Aset -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asset_id">Aset</label>
                            <select name="asset_id" id="asset_id"
                                class="form-control @error('asset_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}"
                                        {{ old('asset_id') == $asset->id ? 'selected' : '' }}>
                                        {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Vendor -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vendor_id">Vendor</label>
                            <select name="vendor_id" id="vendor_id"
                                class="form-control @error('vendor_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Vendor --</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Jumlah -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity">Jumlah</label>
                            <input type="number" name="quantity" id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                                required min="1">
                        </div>
                    </div>

                    <!-- Tanggal Pembelian -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="purchase_date">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" id="purchase_date"
                                class="form-control @error('purchase_date') is-invalid @enderror"
                                value="{{ old('purchase_date', now()->format('Y-m-d')) }}"
                                max="{{ now()->format('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Total Biaya -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_cost">Total Biaya</label>
                            <input type="text" name="total_cost" id="total_cost"
                                class="form-control @error('total_cost') is-invalid @enderror"
                                value="{{ old('total_cost') }}" oninput="formatRupiah(this)"
                                placeholder="Masukkan total biaya" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="3">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function formatRupiah(input) {
            // Ambil nilai input
            let value = input.value;

            // Hapus karakter selain angka
            value = value.replace(/[^,\d]/g, '');

            // Format angka ke dalam format ribuan
            value = new Intl.NumberFormat('id-ID').format(value);

            // Set nilai kembali ke input
            input.value = value;
        }
    </script>

@endsection
