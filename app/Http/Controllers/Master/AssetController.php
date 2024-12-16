<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Master\Category;
use App\Models\Master\Vendor;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'vendor'])->get();
        return view('master.assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $vendors = Vendor::all();

        return view('master.assets.create', compact('categories', 'vendors'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateAsset($request);

        Asset::create($validatedData);

        return redirect()->route('assets.index')->with('success', 'Aset ' . $validatedData['name'] . ' berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $vendors = Vendor::all();

        return view('master.assets.edit', compact('asset', 'categories', 'vendors'));
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
        if ($asset->assetPurchases()->exists()) {
            return redirect()->route('assets.index')->with('error', 'Aset tidak bisa dihapus karena sudah digunakan pada transaksi pembelian aset.');
        }

        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }

    private function validateAsset(Request $request, $id = null)
    {

        $rules = [
            'code' => 'required|string|min:2|max:16|unique:m_assets,code' . ($id ? ",$id" : ''),
            'name' => 'required|string|min:2|max:255',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:m_categories,id',
            'vendor_id' => 'required|exists:m_vendors,id',
            'description' => 'nullable|string',
        ];

        $messages = [
            'code.required' => 'Kode aset wajib diisi!',
            'code.unique' => 'Kode aset sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Kode aset minimal 2 karakter.',
            'code.max' => 'Kode aset maksimal 16 karakter.',
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
        ];

        return $request->validate($rules, $messages);
    }
}
