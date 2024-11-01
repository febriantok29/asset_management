@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Ubah Kategori</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Keterangan</label>
                <textarea class="form-control" name="description" rows="4">{{ $category->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
