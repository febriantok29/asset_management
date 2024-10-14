@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Add New Asset</h1>
        <form action="{{ route('assets.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <!-- Dropdown Category -->
            <div class="form-group mb-3">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="" disabled selected>Silakan pilih</option> <!-- Opsi default -->
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Supplier -->
            <div class="form-group mb-3">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="" disabled selected>Silakan pilih</option> <!-- Opsi default -->
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="purchase_price">Purchase Price</label>
                <input type="number" step="0.01" class="form-control" name="purchase_price" required>
            </div>

            <div class="form-group mb-3">
                <label for="purchase_date">Purchase Date</label>
                <input type="date" class="form-control" name="purchase_date" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
