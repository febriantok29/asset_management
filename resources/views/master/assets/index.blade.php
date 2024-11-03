@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Aset</h1>
        <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">Tambah Aset Baru</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Aset</th>
                        <th>Kode Aset</th>
                        <th>Kategori</th>
                        <th>Pemasok</th>
                        <th>Harga Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $index => $asset)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $asset->name }}</td>
                            <td>{{ $asset->code }}</td>
                            <td>{{ $asset->category ? $asset->category->name : 'Tidak ada kategori' }}</td>
                            <td>{{ $asset->supplier ? $asset->supplier->name : 'Tidak ada pemasok' }}</td>
                            <td>{{ number_format($asset->purchase_price, 2) }}</td>
                            <td>{{ $asset->purchase_date }}</td>
                            <td>
                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
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
                            <td colspan="8" class="text-center">Tidak ada aset yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
