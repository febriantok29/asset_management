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
    public function index()
    {
        $assetPurchases = AssetPurchase::with(['asset', 'vendor'])
            ->orderBy('purchase_date', 'desc')
            ->paginate(10);

        return view('transaction.asset_purchases.index', compact('assetPurchases'));
    }

    public function create()
    {
        $assets = Asset::all();
        $vendors = Vendor::all();

        return view('transaction.asset_purchases.create', compact('assets', 'vendors'));
    }

    public function store(Request $request)
    {
        // Clean the total_cost input before validation
        $request->merge([
            'total_cost' => str_replace(['.', ','], '', $request->input('total_cost'))
        ]);

        $validatedData = $this->validateAssetPurchase($request);
        $validatedData['purchase_code'] = $this->generatePurchaseCode();

        AssetPurchase::create($validatedData);

        return redirect()->route('asset_purchases.index')->with('success', 'Pembelian aset dengan kode ' . $validatedData['purchase_code'] . ' berhasil ditambahkan.');
    }

    public function show(AssetPurchase $assetPurchase)
    {
        return view('transaction.asset_purchases.show', compact('assetPurchase'));
    }

    private function validateAssetPurchase(Request $request, $id = null)
    {
        $rules = [
            'asset_id' => 'required|exists:m_assets,id',
            'vendor_id' => 'required|exists:m_vendors,id',
            'quantity' => 'required|integer|min:1|max:2147483647',
            'purchase_date' => 'required|date',
            'total_cost' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value > 999999999999999999.99) {
                        $fail('Total Biaya tidak boleh lebih dari 999,999,999,999,999,999.99.');
                    }
                },
            ],
            'description' => 'nullable|string',
        ];

        $messages = [
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
        $currentDate = Carbon::now()->format('Y/m/d');
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
