<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Master\Category;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::with(['category', 'supplier'])->get();
        return view('master.assets.index', compact('assets'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('master.assets.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:m_assets,code',
            'category_id' => 'required|exists:m_categories,id',
            'supplier_id' => 'required|exists:m_suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Asset::create($request->only('name', 'code', 'category_id', 'supplier_id', 'purchase_price', 'purchase_date', 'description'));

        return redirect()->route('assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Asset $asset)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('master.assets.edit', compact('asset', 'categories', 'suppliers'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => "required|string|max:50|unique:m_assets,code,{$asset->id}",
            'category_id' => 'required|exists:m_categories,id',
            'supplier_id' => 'required|exists:m_suppliers,id',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $asset->update($request->only('name', 'code', 'category_id', 'supplier_id', 'purchase_price', 'purchase_date', 'description'));

        return redirect()->route('assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('assets.index')->with('success', 'Aset berhasil dihapus.');
    }
}
