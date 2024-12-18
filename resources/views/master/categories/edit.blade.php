@extends('layouts.app')

@section('title', 'Perbarui Kategori')

@section('page_title', 'Perbarui Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('categories.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group mb-3">
                            <label for="name">Nama Kategori</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ $category->name }}"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label for="code">Kode Kategori</label>
                            <input type="text" name="code" id="code"
                                class="form-control @error('code') is-invalid @enderror" value="{{ $category->code }}"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ $category->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>

            </form>
        </div>
    </div>
@endsection
