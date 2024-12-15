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
        $validator = [
            'code' => 'required|string|max:16|unique:m_categories|alpha_num|min:2',
            'name' => 'required|string|max:255|min:2',
            'description' => 'nullable|string',
        ];

        $validatorMessages = [
            'code.required' => 'Kode kategori wajib diisi!',
            'code.unique' => 'Kode kategori sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Silakan masukkan minimal 2 karakter untuk kode kategori.',
            'code.max' => 'Silakan masukkan maksimal 16 karakter untuk kode kategori.',
            'code.alpha_num' => 'Kode kategori hanya boleh berisi huruf dan angka.',
            'name.required' => 'Nama kategori wajib diisi!',
            'name.min' => 'Silakan masukkan minimal 2 karakter untuk nama kategori.',
            'name.max' => 'Silakan masukkan maksimal 255 karakter untuk nama kategori.',
            'description.string' => 'Deskripsi kategori harus berupa teks.',
        ];

        $validatedData = $request->validate($validator, $validatorMessages);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil ditambahkan.');
    }


    private function validateCategory(Request $request, $id = null)
    {
        $rules = [
            'code' => 'required|string|max:16|alpha_num|min:2|unique:m_categories,code' . ($id ? ",$id" : ''),
            'name' => 'required|string|max:255|min:2',
            'description' => 'nullable|string',
        ];

        $messages = [
            'code.required' => 'Kode kategori harus diisi!',
            'code.unique' => 'Kode kategori sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Silakan masukkan minimal 2 karakter untuk kode kategori.',
            'code.max' => 'Silakan masukkan maksimal 16 karakter untuk kode kategori.',
            'code.alpha_num' => 'Kode kategori hanya boleh berisi huruf dan angka.',
            'name.required' => 'Nama kategori harus diisi!',
            'name.min' => 'Silakan masukkan minimal 2 karakter untuk nama kategori.',
            'name.max' => 'Silakan masukkan maksimal 255 karakter untuk nama kategori.',
            'description.string' => 'Deskripsi kategori harus berupa teks.',
        ];

        return $request->validate($rules, $messages);
    }

    // Menampilkan form edit kategori
    public function edit(Category $category)
    {
        return view('master.categories.edit', compact('category'));
    }

    // Mengupdate data kategori yang sudah ada
    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validateCategory($request, $category->id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Berhasil memperbarui kategori ' . $validatedData['name'] . '.');
    }

    // Soft delete kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori ' . $category->name . ' berhasil dihapus.');
    }

    // Mengembalikan data yang di soft delete
    public function restore($id)
    {
        $category = Category::withTrashed()->find($id);
        $category->restore();
        return redirect()->route('categories.index')->with('success', 'Category restored successfully.');
    }

    public function show(Category $category)
    {
        return view('master.categories.show', compact('category'));
    }
}
