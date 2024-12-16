<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\AssetPurchase;
use App\Models\Master\Asset;
use App\Models\Master\Vendor;

class AssetPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetPurchases = AssetPurchase::with(['asset', 'vendor'])->get();

        return view('transaction.asset_purchases.index', compact('assetPurchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assets = Asset::all();
        $vendors = Vendor::all();

        return view('transaction.asset_purchases.create', compact('assets', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateAssetPurchase($request);

        AssetPurchase::create($validatedData);

        return redirect()->route('asset_purchases.index')->with('success', 'Pembelian aset dengan kode ' . $validatedData['purchase_code'] . ' berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssetPurchase $assetPurchase)
    {
        return view('transaction.asset_purchases.show', compact('assetPurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssetPurchase $assetPurchase)
    {
        $assets = Asset::all();
        $vendors = Vendor::all();

        return view('transaction.asset_purchases.edit', compact('assetPurchase', 'assets', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssetPurchase $assetPurchase)
    {
        $validatedData = $this->validateAssetPurchase($request, $assetPurchase->id);

        $assetPurchase->update($validatedData);

        return redirect()->route('asset_purchases.index')->with('success', 'Pembelian aset dengan kode ' . $validatedData['purchase_code'] . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssetPurchase $assetPurchase)
    {
        $assetPurchase->delete();

        return redirect()->route('asset_purchases.index')->with('success', 'Pembelian aset dengan kode ' . $assetPurchase->purchase_code . ' berhasil dihapus.');
    }

    private function validateAssetPurchase(Request $request, $id = null)
    {


        $rules = [
            'purchase_code' => 'required|string|min:2|max:16|unique:t_asset_purchases,purchase_code' . ($id ? ",$id" : ''),
            'asset_id' => 'required|exists:m_assets,id',
            'vendor_id' => 'required|exists:m_vendors,id',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
            'total_cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];

        $messages = [
            'purchase_code.required' => 'Kode Pembelian harus diisi.',
            'purchase_code.string' => 'Kode Pembelian harus berupa teks.',
            'purchase_code.min' => 'Kode Pembelian minimal terdiri dari :min karakter.',
            'purchase_code.max' => 'Kode Pembelian maksimal terdiri dari :max karakter.',
            'purchase_code.unique' => 'Kode Pembelian sudah digunakan.',
            'asset_id.required' => 'Aset harus dipilih.',
            'asset_id.exists' => 'Aset tidak valid.',
            'vendor_id.required' => 'Vendor harus dipilih.',
            'vendor_id.exists' => 'Vendor tidak valid.',
            'quantity.required' => 'Jumlah harus diisi.',
            'quantity.integer' => 'Jumlah harus berupa angka.',
            'quantity.min' => 'Jumlah minimal :min.',
            'purchase_date.required' => 'Tanggal Pembelian harus diisi.',
            'purchase_date.date' => 'Tanggal Pembelian harus berupa tanggal.',
            'total_cost.required' => 'Total Biaya harus diisi.',
            'total_cost.numeric' => 'Total Biaya harus berupa angka.',
            'total_cost.min' => 'Total Biaya minimal :min.',
            'description.string' => 'Deskripsi harus berupa teks.',
        ];

        return $request->validate($rules, $messages);
    }
}
