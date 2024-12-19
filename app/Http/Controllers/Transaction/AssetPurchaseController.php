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

        $validatedData['total_cost'] = str_replace('.', '', $request->input('total_cost'));

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

    private function validateAssetPurchase(Request $request, $id = null)
    {
        $rules = [
            'asset_id' => 'required|exists:m_assets,id',
            'vendor_id' => 'required|exists:m_vendors,id',
            'quantity' => 'required|integer|min:1',
            'purchase_date' => 'required|date',
            'total_cost' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ];

        $messages = [
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

    private function generatePurchaseCode(): string
    {
        $currentDate = now()->format('Y/m/d');
        $lastPurchase = AssetPurchase::latest('id')->first();

        if (!$lastPurchase) {
            return $currentDate . '-AP001';
        }

        $lastPurchaseCode = $lastPurchase->purchase_code;
        $lastPurchaseNumber = (int) substr($lastPurchaseCode, -3);
        $newPurchaseNumber = str_pad($lastPurchaseNumber + 1, 3, '0', STR_PAD_LEFT);

        return $currentDate . '-AP' . $newPurchaseNumber;
    }
}
