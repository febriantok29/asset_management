@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('page_title', 'Detail Kategori')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group mb-3">
                        <label for="name">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $category->name }}" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="code">Kode Kategori</label>
                        <input type="text" name="code" id="code" class="form-control"
                            value="{{ $category->code }}" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" readonly>{{ $category->description }}</textarea>
            </div>
        </div>
    </div>
@endsection