<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction\AssetPurchase;
use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use Carbon\Carbon;


class AssetPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetPurchases = AssetPurchase::with(['asset', 'vendor'])
            ->orderBy('purchase_date', 'desc')
            ->paginate(10);

        // Format tanggal dan total_cost untuk setiap item
        $assetPurchases->getCollection()->each(function ($purchase) {
            $purchase->purchase_date = Carbon::parse($purchase->purchase_date)
                ->translatedFormat('l, d F Y');
            $purchase->total_cost = 'Rp ' . number_format($purchase->total_cost, 0, ',', '.');
        });

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

        $validatedData['purchase_code'] = $this->generatePurchaseCode();

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
    /**
     * Generate a unique purchase code for asset purchases.
     *
     * The purchase code format is YYYY/MM/DD-AP###, where ### is a sequential number
     * that resets each day. For example:
     * - 2024/12/15-AP001 (first purchase of the day)
     * - 2024/12/15-AP002 (second purchase of the same day)
     *
     * @return string The generated purchase code.
     */
    private function generatePurchaseCode(): string
    {
        // Get the current date in the format YYYY/MM/DD.
        $currentDate = date('Y/m/d');

        // Retrieve the most recent purchase, ordered by `purchase_code` in descending order.
        // This ensures we get the latest purchase code.
        $lastPurchase = AssetPurchase::orderBy('purchase_code', 'desc')->first();

        // If there are no previous purchases, start with the first code of the day.
        if (!$lastPurchase) {
            return $currentDate . '-AP001'; // Example: 2024/12/15-AP001
        }

        // Extract the `purchase_code` from the last purchase record.
        $lastPurchaseCode = $lastPurchase->purchase_code;

        // Extract the date portion (first 10 characters) from the last purchase code.
        $lastPurchaseDate = substr($lastPurchaseCode, 0, 10);

        // If the last purchase date does not match the current date, reset the sequence to 1.
        if ($lastPurchaseDate != $currentDate) {
            return $currentDate . '-AP001'; // Start a new sequence for the new date.
        }

        // Extract the numeric portion (last 3 characters) and convert it to an integer.
        $lastPurchaseNumber = (int) substr($lastPurchaseCode, -3);

        // Increment the numeric portion of the last purchase code by 1.
        $newPurchaseNumber = $lastPurchaseNumber + 1;

        // Return the new purchase code with the current date and the new number, padded to 3 digits.
        return $currentDate . '-AP' . str_pad($newPurchaseNumber, 3, '0', STR_PAD_LEFT);
        // Example: 2024/12/15-AP002, 2024/12/15-AP003, etc.
    }
}
