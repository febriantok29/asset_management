<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Master\Asset;
use App\Models\Master\AssetLocation;
use App\Models\Transaction\AssetTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AssetTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assetTransfers = AssetTransfer::with(['asset', 'fromLocation', 'toLocation'])
            ->orderBy('transfer_date', 'desc')->paginate(10);

        return view('transaction.asset_transfers.index', compact('assetTransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Get assets with their current locations and stock
    $assets = Asset::select(
            'm_assets.id',
            'm_assets.name',
            'm_assets.stock',
            'm_assets.location_id',
            'l.name as location_name'
        )
        ->leftJoin('m_locations as l', 'l.id', '=', 'm_assets.location_id')
        ->where('m_assets.stock', '>', 0)
        ->orderBy('m_assets.name')
        ->get();

    // Get all active locations
    $locations = AssetLocation::orderBy('name')->get();

    return view('transaction.asset_transfers.create', compact('assets', 'locations'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateAssetTransfer($request);
        $validatedData['transfer_code'] = $this->generateTransferCode();

        // Begin transaction to ensure data consistency
        DB::beginTransaction();
        try {
            // Create transfer record
            AssetTransfer::create($validatedData);

            // Get the source asset
            $sourceAsset = Asset::findOrFail($validatedData['asset_id']);
            
            // Check if source has enough stock
            if ($sourceAsset->stock < $validatedData['quantity']) {
                throw new \Exception('Stock tidak mencukupi untuk transfer');
            }
            
            // Reduce stock from source asset
            $sourceAsset->stock -= $validatedData['quantity'];
            $sourceAsset->save();

            // Check if destination already has the same asset
            $destinationAsset = Asset::where('name', $sourceAsset->name)
                ->where('location_id', $validatedData['to_location_id'])
                ->first();

            if ($destinationAsset) {
                // If exists, just add the quantity
                $destinationAsset->stock += $validatedData['quantity'];
                $destinationAsset->save();
            } else {
                // Create new asset at destination with new code
                $newAssetCode = $sourceAsset->code . rand(100, 999);
                $destinationAsset = Asset::create([
                    'code' => $newAssetCode,
                    'name' => $sourceAsset->name,
                    'description' => $sourceAsset->description,
                    'location_id' => $validatedData['to_location_id'],
                    'stock' => $validatedData['quantity'],
                    'category_id' => $sourceAsset->category_id,
                    'unit_id' => $sourceAsset->unit_id,
                ]);
            }

            DB::commit();

            return redirect()->route('asset_transfers.index')
                ->with('success', 'Transfer aset dengan kode ' . $validatedData['transfer_code'] . ' berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memproses transfer aset: ' . $e->getMessage());
        }
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
            'asset_id' => 'required|exists:m_assets,id',
            'from_location_id' => 'required|exists:m_locations,id',
            'to_location_id' => 'required|exists:m_locations,id',
            'quantity' => 'required|integer|min:1',
            'transfer_date' => 'required|date',
            'description' => 'nullable|string',
        ];

        $messages = [
            'asset_id.required' => 'Silakan pilih aset yang akan ditransfer.',
            'asset_id.exists' => 'Silakan pilih aset yang tersedia.',
            'from_location_id.required' => 'Silakan pilih asal lokasi transfer.',
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

    public function getAssetLocation($assetId)
    {
        $lastTransfer = AssetTransfer::where('asset_id', $assetId)->latest('id')->first();

        if (!$lastTransfer) {
            return response()->json([
                'from_location_id' => null,
                'from_location_name' => null,
            ]);
        }

        return response()->json([
            'from_location_id' => $lastTransfer->to_location_id ?? null,
            'from_location_name' => $lastTransfer->toLocation->name ?? null,
        ]);
    }
}
