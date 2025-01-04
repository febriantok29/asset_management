<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
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
        $assets = Asset::all();
        return view('transaction.asset_maintenances.create', compact('assets'));
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
            'asset_id' => 'required|exists:m_assets,id',
            'maintenance_date' => 'required|date|before_or_equal:today',
            'issue' => 'nullable',
            'technician' => 'nullable',
            'cost' => 'nullable|numeric',
        ];

        $messages = [
            'asset_id.required' => 'Aset harus dipilih.',
            'asset_id.exists' => 'Aset tidak valid.',
            'maintenance_date.required' => 'Tanggal Maintenance harus diisi.',
            'maintenance_date.date' => 'Tanggal Maintenance harus berupa tanggal.',
            'maintenance_date.before_or_equal' => 'Tanggal Maintenance tidak boleh lebih dari hari ini.',
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
