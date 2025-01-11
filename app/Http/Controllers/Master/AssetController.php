<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Master\Category;
use App\Models\Master\AssetLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $assets = Asset::with(['category', 'location'])
            ->when($search, function ($query, $search) {
                return $query->where('code', 'like', "%{$search}%")

                             ->orWhere('name', 'like', "%{$search}%")
                             ->orWhereHas('category', function ($query) use ($search) {
                                 $query->where('name', 'like', "%{$search}%");
                             })
                             ->orWhereHas('location', function ($query) use ($search) {
                                 $query->where('name', 'like', "%{$search}%");
                             });
            })
            ->paginate(10);
        return view('master.assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $locations = AssetLocation::all();

        return view('master.assets.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateAsset($request);

        $existingAsset = Asset::withTrashed()->where('code', $validatedData['code'])->first();
        if ($existingAsset && $existingAsset->trashed()) {
            $existingAsset->restore();
            $existingAsset->update($validatedData);

            return redirect()->route('assets.index')->with('success', 'Aset ' . $validatedData['name'] . ' berhasil dipulihkan dan telah diperbarui.');
        }

        Asset::create($validatedData);

        return redirect()->route('assets.index')->with('success', 'Aset ' . $validatedData['name'] . ' berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $locations = AssetLocation::all();

        return view('master.assets.edit', compact('asset', 'categories', 'locations'));
    }

    public function update(Request $request, Asset $asset)
    {
        $validatedData = $this->validateAsset($request, $asset->id);

        $asset->update($validatedData);

        return redirect()->route('assets.index')->with('success', 'Aset ' . $validatedData['name'] . ' berhasil diperbarui.');
    }

    public function show(Asset $asset)
    {
        return view('master.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }

    private function validateAsset(Request $request, $id = null)
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:16',
                'regex:/^[a-zA-Z0-9-]+$/',
                Rule::unique('m_assets', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
            'name' => 'required|string|min:2|max:255',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:m_categories,id',
            'location_id' => 'required|exists:m_locations,id',
            'description' => 'nullable|string|max:1000',
        ];

        $messages = [
            'code.required' => 'Kode aset wajib diisi!',
            'code.unique' => 'Kode aset sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Kode aset minimal 2 karakter.',
            'code.max' => 'Kode aset maksimal 16 karakter.',
            'code.regex' => 'Kode aset hanya boleh mengandung huruf, angka, dan tanda hubung (-).',
            'name.required' => 'Nama aset wajib diisi!',
            'name.min' => 'Nama aset minimal 2 karakter.',
            'name.max' => 'Nama aset maksimal 255 karakter.',
            'stock.required' => 'Stok aset wajib diisi!',
            'stock.integer' => 'Stok aset harus berupa angka.',
            'stock.min' => 'Stok aset minimal 0.',
            'category_id.required' => 'Kategori aset wajib diisi!',
            'category_id.exists' => 'Kategori aset tidak valid.',
            'vendor_id.required' => 'Vendor aset wajib diisi!',
            'vendor_id.exists' => 'Vendor aset tidak valid.',
            'description.string' => 'Deskripsi aset harus berupa teks.',
            'description.max' => 'Deskripsi aset maksimal 1000 karakter.',
        ];

        return $request->validate($rules, $messages);
    }
}
