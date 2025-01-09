@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Aset</h1>
        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group mb-3">
                        <label for="name">Nama Aset</label>
                        <input type="text" name="name" class="form-control" value="{{ $asset->name }}" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-3">
                        <label for="code">Kode Aset</label>
                        <input type="text" name="code" class="form-control" value="{{ $asset->code }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="category_id">Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="location_id">location</label>
                        <select name="location_id" class="form-control" required>
                            <option value="">Pilih location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ $asset->location_id == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="stock">Jumlah</label>
                <input type="number" name="stock" class="form-control" value="{{ $asset->stock }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $asset->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
            </a>
        </form>
    </div>
@endsection
