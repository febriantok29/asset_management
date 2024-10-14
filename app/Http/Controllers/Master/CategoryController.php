<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all(); // Mengambil semua data kategori yang tidak dihapus
        return view('master.categories.index', compact('categories'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        return view('master.categories.create');
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Menampilkan form edit kategori
    public function edit(Category $category)
    {
        return view('master.categories.edit', compact('category'));
    }

    // Mengupdate data kategori yang sudah ada
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Soft delete kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category soft deleted successfully.');
    }

    // Mengembalikan data yang di soft delete
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();
        return redirect()->route('categories.index')->with('success', 'Category restored successfully.');
    }
}
