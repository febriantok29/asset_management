@extends('layouts.app')

@section('title', 'Tambah Perawatan Asset')

@section('page_title', 'Tambah Perawatan Asset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('asset_maintenances.index') }}">Daftar Perawatan Asset</a></li>
    <li class="breadcrumb-item active">Tambah Perawatan Asset</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Perawatan Asset</h3>
        </div>
        <form action="{{ route('asset_maintenances.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asset_id">Asset</label>
                            <select name="asset_id" id="asset_id" class="form-control">
                                @foreach ($assets as $asset)
                                    <option value="{{ $asset->id }}" {{ old('asset_id') == $asset->id ? 'selected' : '' }}>{{ $asset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="maintenance_date">Tanggal Perawatan</label>
                            <input type="date" name="maintenance_date" id="maintenance_date" class="form-control" max="{{ now()->format('Y-m-d') }}" value="{{ old('maintenance_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="issue">Masalah</label>
                            <textarea name="issue" id="issue" class="form-control">{{ old('issue') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="technician">Teknisi</label>
                            <input type="text" name="technician" id="technician" class="form-control" value="{{ old('technician') }}">
                        </div>
                        <div class="form-group">
                            <label for="cost">Biaya</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="cost" id="cost" class="form-control" value="{{ old('cost') }}" oninput="formatRupiah(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('asset_maintenances.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah;
    }
</script>
@endpush