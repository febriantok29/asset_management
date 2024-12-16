@extends('layouts.app')

@section('title', 'Pengajuan Pembelian Aset')

@section('page_title', 'Pengajuan Pembelian Aset')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
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
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="purchase_date">Tanggal Pembelian</label>
                            <input type="date" name="purchase_date" id="purchase_date"
                                class="form-control @error('purchase_date') is-invalid @enderror"
                                value="{{ old('purchase_date') }}" required>
                        </div>
                    </div>
                    {{-- Code is read-only, and auto generate from controller --}}
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="purchase_code">Kode Pembelian</label>
                            <input type="text" name="purchase_code" id="purchase_code"
                                class="form-control @error('purchase_code') is-invalid @enderror"
                                value="{{ old('purchase_code') }}" readonly required>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vendor_id">Vendor</label>
                            <select name="vendor_id" id="vendor_id"
                                class="form-control @error('vendor_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Vendor --</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}" @if (old('vendor_id') == $vendor->id) selected @endif>
                                        {{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="asset_id">Aset</label>
                            <select name="asset_id" id="asset_id"
                                class="form-control @error('asset_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Aset --</option>
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}" @if (old('asset_id') == $asset->id) selected @endif>
                                        {{ $asset->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="quantity">Jumlah</label>
                            <input type="number" name="quantity" id="quantity"
                                class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="total_cost">Total Harga</label>
                            <input type="number" name="total_cost" id="total_cost"
                                class="form-control @error('total_cost') is-invalid @enderror"
                                value="{{ old('total_cost') }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
            </form>
        </div>
    </div>
@endsection
