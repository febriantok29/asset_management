<!-- create view for master/vendors -->

@extends('layouts.app')

@section('title', 'Buat Vendor Baru')

@section('page_title', 'Buat Vendor Baru')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Buat Vendor Baru</div>
        <div class="card-body">
            <form action="{{ route('vendors.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="name">Nama Vendor</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="code">Kode Vendor</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                                required>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="phone">Telepon</label>
                            <input type="text" name="phone" id="phone"
                                class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                required>
                        </div>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
