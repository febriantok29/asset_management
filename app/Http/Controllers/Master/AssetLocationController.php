<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\AssetLocation;
use Illuminate\Http\Request;

class AssetLocationController extends Controller
{
    public function index()
    {
        $locations = AssetLocation::all();
        return view('master.asset_locations.index', compact('locations'));
    }

    public function create()
    {
        return view('master.asset_locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:m_asset_locations,name',
            'code' => 'required|string|max:50|unique:m_asset_locations,code',
            'description' => 'nullable|string',
        ]);

        AssetLocation::create($request->only('name', 'code', 'description'));

        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil ditambahkan.');
    }

    public function edit(AssetLocation $assetLocation)
    {
        return view('master.asset_locations.edit', compact('assetLocation'));
    }

    public function update(Request $request, AssetLocation $assetLocation)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:m_asset_locations,name,{$assetLocation->id}",
            'code' => "required|string|max:50|unique:m_asset_locations,code,{$assetLocation->id}",
            'description' => 'nullable|string',
        ]);

        $assetLocation->update($request->only('name', 'code', 'description'));

        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil diperbarui.');
    }

    public function destroy(AssetLocation $assetLocation)
    {
        $assetLocation->delete();
        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil dihapus.');
    }
}
