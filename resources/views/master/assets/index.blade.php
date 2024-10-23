@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Assets</h1>
        <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">Add New Asset</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Purchase Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $index => $asset)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ optional($asset->category)->name }}</td> <!-- Cek apakah kategori ada -->
                        <td>{{ optional($asset->supplier)->name }}</td> <!-- Cek apakah supplier ada -->
                        <td>{{ $asset->purchase_price }}</td>
                        <td>{{ $asset->purchase_date }}</td>
                        <td>
                            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" style="display:inline;">
                                @c  srf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
