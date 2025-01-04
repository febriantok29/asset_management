@extends('layouts.app')

@section('title', 'Tambah Perbaikan Aset')

@section('page_title', 'Tambah Perbaikan Aset')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('asset_repairs.index') }}">Daftar Perbaikan Aset</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('asset_repairs.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="asset_id">Aset</label>
                            <select name="asset_id" id="asset_id" class="form-control">
                                @foreach($assets as $asset)
                                <option value="{{ $asset->id }}">{{ $asset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="technician_name">Nama Teknisi</label>
                            <input type="text" name="technician_name" id="technician_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="repair_date">Tanggal Perbaikan</label>
                            <input type="date" name="repair_date" id="repair_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cost">Biaya</label>
                            <input type="number" name="cost" id="cost" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="PENDING">PENDING</option>
                                <option value="ONGOING">ONGOING</option>
                                <option value="COMPLETED">COMPLETED</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="issue_description">Deskripsi Masalah</label>
                            <textarea name="issue_description" id="issue_description" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection