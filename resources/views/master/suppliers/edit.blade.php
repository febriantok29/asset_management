@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Supplier</h1>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="{{ $supplier->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="{{ $supplier->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $supplier->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="address">Address</label>
                <textarea class="form-control" name="address">{{ $supplier->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
