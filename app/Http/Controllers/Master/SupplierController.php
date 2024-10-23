<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('master.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('master.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        Supplier::create([
            'code' => $this->generateUniqueCode(),
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('master.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->only('name', 'contact_number', 'email', 'address'));

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }

    private function generateUniqueCode()
    {
        $lastSupplier = Supplier::orderBy('id', 'desc')->first();
        $nextNumber = $lastSupplier ? ((int) substr($lastSupplier->code, 1)) + 1 : 1;
        return 'S' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
