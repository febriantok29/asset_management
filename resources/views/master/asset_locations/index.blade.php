@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Lokasi Aset</h1>
        <a href="{{ route('asset_locations.create') }}" class="btn btn-primary mb-3">Tambah Lokasi Aset Baru</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Kode Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $index => $location)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $location->name }}</td>
                            <td>{{ $location->code }}</td>
                            <td>{{ $location->description }}</td>
                            <td>
                                <a href="{{ route('asset_locations.edit', $location->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('asset_locations.destroy', $location->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lokasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada lokasi aset yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
