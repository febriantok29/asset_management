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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Cari kode terbesar saat ini dari kategori yang ada, tanpa bergantung pada ID
        $lastCode = Category::withTrashed()
            ->where('code', 'LIKE', 'C%')
            ->orderBy('code', 'desc')
            ->first();

        // Jika tidak ada kode yang ditemukan, mulai dari 'C001'
        if ($lastCode) {
            // Ekstrak angka setelah prefix 'C'
            $lastNumber = intval(substr($lastCode->code, 1));
            // Increment nomor
            $newCodeNumber = $lastNumber + 1;
        } else {
            $newCodeNumber = 1;
        }

        // Pastikan kode tidak melebihi batas 999
        if ($newCodeNumber > 999) {
            return redirect()->back()->withErrors(['code' => 'Jumlah kategori telah mencapai batas maksimum']);
        }

        // Format kode baru dengan zero-padding
        $newCode = 'C' . str_pad($newCodeNumber, 3, '0', STR_PAD_LEFT);

        // Simpan kategori baru
        Category::create([
            'code' => $newCode,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.index')->with('success', 'Berhasil menambahkan kategori baru.');
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
