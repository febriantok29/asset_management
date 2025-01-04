<?php

namespace App\Http\Controllers\Master;

use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categories = Category::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('code', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->get();

        return view('master.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('master.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCategory($request);

        $existingCategory = Category::withTrashed()->where('code', $validatedData['code'])->first();
        if ($existingCategory && $existingCategory->trashed()) {
            $existingCategory->restore();
            $existingCategory->update($validatedData);

            return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil dipulihkan dan telah diperbarui.');
        }

        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Kategori ' . $validatedData['name'] . ' berhasil ditambahkan.');
    }

    private function validateCategory(Request $request, $id = null)
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:16',
                'alpha_num',
                Rule::unique('m_categories', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
            'name' => 'required|string|min:2|max:255',
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

    public function edit(Category $category)
    {
        return view('master.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $this->validateCategory($request, $category->id);
        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Berhasil memperbarui kategori ' . $validatedData['name'] . '.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori ' . $category->name . ' berhasil dihapus.');
    }

    public function show(Category $category)
    {
        return view('master.categories.show', compact('category'));
    }
}
