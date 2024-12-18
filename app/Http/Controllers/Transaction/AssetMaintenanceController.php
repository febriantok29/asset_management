<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\AssetMaintenance;
use Illuminate\Http\Request;

class AssetMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetMaintenances = AssetMaintenance::with('asset')
            ->orderBy('maintenance_date', 'desc')->get();

        return view('transaction.asset_maintenances.index', compact('assetMaintenances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.asset_maintenances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateAssetMaintenance($request);

        $validatedData['maintenance_code'] = $this->generateMaintenanceCode();

        AssetMaintenance::create($validatedData);

        return redirect()->route('asset_maintenances.index')->with('success', 'Maintenance aset dengan kode ' . $validatedData['maintenance_code'] . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetMaintenance $assetMaintenance)
    {
        return view('transaction.asset_maintenances.show', compact('assetMaintenance'));
    }

    private function validateAssetMaintenance(Request $request)
    {
        $rules = [
            'maintenance_code' => 'required|string|min:2|max:16|unique:t_asset_maintenance,maintenance_code',
            'asset_id' => 'required|exists:m_assets,id',
            'maintenance_date' => 'required|date',
            'issue' => 'nullable',
            'technician' => 'nullable',
            'cost' => 'nullable|numeric',
        ];

        $messages = [
            'maintenance_code.required' => 'Kode Maintenance harus diisi.',
            'maintenance_code.string' => 'Kode Maintenance harus berupa teks.',
            'maintenance_code.min' => 'Kode Maintenance minimal terdiri dari :min karakter.',
            'maintenance_code.max' => 'Kode Maintenance maksimal terdiri dari :max karakter.',
            'maintenance_code.unique' => 'Kode Maintenance sudah digunakan.',
            'asset_id.required' => 'Aset harus dipilih.',
            'asset_id.exists' => 'Aset tidak valid.',
            'maintenance_date.required' => 'Tanggal Maintenance harus diisi.',
            'maintenance_date.date' => 'Tanggal Maintenance harus berupa tanggal.',
            'cost.numeric' => 'Biaya Maintenance harus berupa angka.',
        ];

        return $request->validate($rules, $messages);
    }

    private function generateMaintenanceCode()
    {
        $currentDate = now()->format('Y/m/d');
        $lastMaintenance = AssetMaintenance::latest('id')->first();

        if (!$lastMaintenance) {
            return $currentDate . '-AM001';
        }

        $lastMaintenanceCode = $lastMaintenance->maintenance_code;
        $lastMaintenanceNumber = (int) substr($lastMaintenanceCode, -3);
        $newMaintenanceNumber = str_pad($lastMaintenanceNumber + 1, 3, '0', STR_PAD_LEFT);

        return $currentDate . '-AM' . $newMaintenanceNumber;
    }
}
