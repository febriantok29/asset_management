<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use App\Models\Master\Asset;
use App\Models\Master\AssetLocation;
use App\Models\Transaction\AssetTransfer;



class AssetTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetTransfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation'])
            ->orderBy('transfer_date', 'desc')->get();

        return view('transaction.asset_transfers.index', compact('assetTransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::all();
        $locations = AssetLocation::all();

        return view('transaction.asset_transfers.create', compact('assets', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateAssetTransfer($request);

        $validatedData['transfer_code'] = $this->generateTransferCode();

        AssetTransfer::create($validatedData);

        return redirect()->route('asset_transfers.index')->with('success', 'Transfer aset dengan kode ' . $validatedData['transfer_code'] . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetTransfer $assetTransfer)
    {
        return view('transaction.asset_transfers.show', compact('assetTransfer'));
    }

    private function validateAssetTransfer(Request $request)
    {
        $rules = [
            'transfer_code' => 'required|string|min:2|max:16|unique:t_asset_transfers,transfer_code',
            'asset_id' => 'required|exists:m_assets,id',
            'from_location_id' => 'nullable|exists:m_locations,id',
            'to_location_id' => 'required|exists:m_locations,id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
            'description' => 'nullable|string',
        ];

        $messages = [
            'asset_id.required' => 'Silakan pilih aset yang akan ditransfer.',
            'asset_id.exists' => 'Silakan pilih aset yang tersedia.',
            'from_location_id.exists' => 'Silakan pilih asal lokasi yang valid.',
            'to_location_id.required' => 'Silakan pilih tujuan lokasi transfer.',
            'to_location_id.exists' => 'Silakan pilih tujuan lokasi yang valid.',
            'quantity.required' => 'Jumlah aset yang ditransfer harus diisi.',
            'quantity.integer' => 'Jumlah aset yang ditransfer harus berupa angka.',
            'quantity.min' => 'Jumlah aset yang ditransfer minimal 1.',
            'transfer_date.required' => 'Tanggal transfer harus diisi.',
            'transfer_date.date' => 'Tanggal transfer harus berupa tanggal.',
        ];

        return $request->validate($rules, $messages);
    }

    // Auto-Generated, with format: YYYY/MM/DD-ATXXX, where XXX is auto-increment with "0" padding
    private function generateTransferCode()
    {
        $currentDate = now()->format('Y/m/d');
        $lastTransfer = AssetTransfer::latest('id')->first();

        if (!$lastTransfer) {
            return $currentDate . '-AT001';
        }

        $lastCode = $lastTransfer->transfer_code;
        $lastNumber = (int) substr($lastCode, -3);
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        return $currentDate . '-AT' . $newNumber;
    }
}
