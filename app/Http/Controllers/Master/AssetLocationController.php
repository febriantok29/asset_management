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
        $validatedData = $this->validateAssetLocation($request);

        AssetLocation::create($validatedData);

        return redirect()->route('asset_locations.index')->with('success', 'Location aset berhasil ditambahkan.');
    }

    public function edit(AssetLocation $assetLocation)
    {
        return view('master.asset_locations.edit', compact('assetLocation'));
    }

    public function update(Request $request, AssetLocation $assetLocation)
    {
        $validatedData = $this->validateAssetLocation($request, $assetLocation->id);

        $assetLocation->update($validatedData);

        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil diperbarui.');
    }

    public function destroy(AssetLocation $assetLocation)
    {
        if ($assetLocation->assetTransfersFrom->count() > 0 || $assetLocation->assetTransfersTo->count() > 0) {
            return redirect()->route('asset_locations.index')->with('error', 'Lokasi aset tidak bisa dihapus karena terdapat aset yang menggunakan lokasi ini.');
        }

        $assetLocation->delete();
        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil dihapus.');
    }

    private function validateAssetLocation(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required|string|min:2|max:255|unique:m_asset_locations,name' . ($id ? ",$id" : ''),
            'code' => 'required|string|min:2|max:50|unique:m_asset_locations,code' . ($id ? ",$id" : ''),
            'address' => 'nullable|string',
        ];

        $messages = [
            'name.required' => 'Nama lokasi aset wajib diisi!',
            'name.min' => 'Nama lokasi aset minimal terdiri dari 2 karakter.',
            'name.max' => 'Nama lokasi aset maksimal terdiri dari 255 karakter.',
            'name.unique' => 'Nama lokasi aset sudah digunakan, silakan gunakan nama lain.',
            'code.required' => 'Kode lokasi aset wajib diisi!',
            'code.min' => 'Kode lokasi aset minimal terdiri dari 2 karakter.',
            'code.max' => 'Kode lokasi aset maksimal terdiri dari 50 karakter.',
            'code.unique' => 'Kode lokasi aset sudah digunakan, silakan gunakan kode lain.',
            'address.string' => 'Alamat lokasi aset harus berupa teks.',
        ];

        return $request->validate($rules, $messages);
    }
}
