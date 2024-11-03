<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetTransactionRequest;
use App\Models\Transaction\AssetTransaction;
use App\Models\Master\Asset;
use Illuminate\Http\Request;

class AssetTransactionController extends Controller
{
    public function index()
    {
        $transactions = AssetTransaction::with('asset')->paginate(10);
        return view('transaction.asset_transactions.index', compact('transactions'));
    }

    public function create()
    {
        $assets = Asset::all();
        return view('transaction.asset_transactions.create', compact('assets'));
    }

    public function store(AssetTransactionRequest $request)
    {
        $validated = $request->validated();
        $validated['code'] = $this->generateUniqueCode();
        AssetTransaction::create($validated);

        return redirect()->route('asset_transactions.index')
            ->with('success', 'Transaksi aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $transaction = AssetTransaction::findOrFail($id);
        $assets = Asset::all();
        return view('transaction.asset_transactions.edit', compact('transaction', 'assets'));
    }

    public function update(AssetTransactionRequest $request, $id)
    {
        $transaction = AssetTransaction::findOrFail($id);
        $validated = $request->validated();
        $transaction->update($validated);

        return redirect()->route('asset_transactions.index')
            ->with('success', 'Transaksi aset berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaction = AssetTransaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('asset_transactions.index')
            ->with('success', 'Transaksi aset berhasil dihapus.');
    }

    private function generateUniqueCode()
    {
        $lastTransaction = AssetTransaction::orderBy('created_at', 'desc')->first();
        $lastCode = $lastTransaction ? intval(substr($lastTransaction->code, 1)) : 0;
        $newCode = str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
        return 'T' . $newCode;
    }
}
