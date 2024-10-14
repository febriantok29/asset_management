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
            'category_id' => 'required|exists:m_categories,id',
            'supplier_id' => 'required|exists:m_suppliers,id',
            'purchase_price' => 'required|numeric',
            'purchase_date' => 'required|date',
        ]);

        Asset::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset created successfully.');
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
            'category_id' => 'required|exists:m_categories,id',
            'supplier_id' => 'required|exists:m_suppliers,id',
            'purchase_price' => 'required|numeric',
            'purchase_date' => 'required|date',
        ]);

        $asset->update($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset deleted successfully.');
    }
}
