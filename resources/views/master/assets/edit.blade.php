@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Asset</h1>
        <form action="{{ route('assets.update', $asset->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $asset->name }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $asset->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" step="0.01" class="form-control" name="purchase_price"
                    value="{{ $asset->purchase_price }}" required>
            </div>
            <div class="form-group mb-3">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" class="form-control" name="purchase_date" value="{{ $asset->purchase_date }}"
                    required>
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description">{{ $asset->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
