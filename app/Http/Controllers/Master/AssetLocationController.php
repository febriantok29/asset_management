<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\AssetLocation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AssetLocationController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $locations = AssetLocation::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('code', 'like', "%{$search}%");
    })->paginate(10);

    return view('master.asset_locations.index', compact('locations'));
}

    public function create()
    {
        return view('master.asset_locations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateAssetLocation($request);

        $existingLocation = AssetLocation::withTrashed()->where('code', $validatedData['code'])->first();
        if ($existingLocation && $existingLocation->trashed()) {
            $existingLocation->restore();
            $existingLocation->update($validatedData);

            return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil dipulihkan dan diperbarui.');
        }

        AssetLocation::create($validatedData);

        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil ditambahkan.');
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

    public function show(AssetLocation $assetLocation)
    {
        return view('master.asset_locations.show', compact('assetLocation'));
    }

    public function destroy(AssetLocation $assetLocation)
    {
        $assetLocation->delete();
        return redirect()->route('asset_locations.index')->with('success', 'Lokasi aset berhasil dihapus.');
    }

    private function validateAssetLocation(Request $request, $id = null)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                Rule::unique('m_locations', 'name')->ignore($id)->whereNull('deleted_at'),
            ],
            'code' => [
                'required',
                'string',
                'min:2',
                'max:50',
                'alpha_num',
                Rule::unique('m_locations', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
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
