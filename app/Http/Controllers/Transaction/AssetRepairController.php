<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction\AssetRepair;
use App\Models\Master\Asset;
use Illuminate\Http\Request;

class AssetRepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetRepairs = AssetRepair::with('asset')
            ->orderBy('repair_date', 'desc')->get();

        return view('transaction.asset_repairs.index', compact('assetRepairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::all();
        return view('transaction.asset_repairs.create', compact('assets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateAssetRepair($request);

        $validatedData['repair_code'] = $this->generateRepairCode();

        AssetRepair::create($validatedData);

        return redirect()->route('asset_repairs.index')->with('success', 'Repair aset dengan kode ' . $validatedData['repair_code'] . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetRepair $assetRepair)
    {
        return view('transaction.asset_repairs.show', compact('assetRepair'));
    }

    private function validateAssetRepair(Request $request)
    {
        $rules = [
            'asset_id' => 'required|exists:m_assets,id',
            'technician_name' => 'nullable',
            'repair_date' => 'required|date',
            'cost' => 'nullable|numeric',
            'issue_description' => 'nullable',
            'status' => 'required|in:PENDING,ONGOING,COMPLETED',
        ];

        $messages = [
            'asset_id.required' => 'Silakan pilih aset yang akan diperbaiki.',
            'asset_id.exists' => 'Silakan pilih aset yang tersedia.',
            'repair_date.required' => 'Tanggal repair harus diisi.',
            'repair_date.date' => 'Tanggal repair harus berupa tanggal.',
            'cost.numeric' => 'Biaya repair harus berupa angka.',
            'status.required' => 'Status repair harus diisi.',
            'status.in' => 'Status repair harus PENDING, ONGOING, atau COMPLETED.',
        ];

        return $request->validate($rules, $messages);
    }

    private function generateRepairCode()
    {
        $currentDate = now()->format('Y/m/d');
        $lastRepair = AssetRepair::latest('id')->first();

        if (!$lastRepair) {
            return $currentDate . '-AR001';
        }

        $lastRepairCode = $lastRepair->repair_code;
        $lastRepairNumber = (int) substr($lastRepairCode, -3);
        $newRepairNumber = str_pad($lastRepairNumber + 1, 3, '0', STR_PAD_LEFT);

        return $currentDate . '-AR' . $newRepairNumber;
    }
}
