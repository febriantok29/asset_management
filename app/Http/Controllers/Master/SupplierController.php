<?php
namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    // Menampilkan semua supplier
    public function index()
    {
        $suppliers = Supplier::all();
        return view('master.suppliers.index', compact('suppliers'));
    }

    // Menampilkan form tambah supplier
    public function create()
    {
        return view('master.suppliers.create');
    }

    // Menyimpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:m_suppliers,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string'
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    // Menampilkan form edit supplier
    public function edit(Supplier $supplier)
    {
        return view('master.suppliers.edit', compact('supplier'));
    }

    // Mengupdate supplier
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:m_suppliers,email,'.$supplier->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string'
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    // Menghapus supplier (soft delete)
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
