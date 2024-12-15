@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('page_title', 'Daftar Kategori')

@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
@endsection

@section('content')
    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->code }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
