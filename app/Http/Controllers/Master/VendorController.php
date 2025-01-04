<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all();
        return view('master.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateVendor($request);

        $existingVendor = Vendor::withTrashed()->where('code', $validatedData['code'])->first();
        if ($existingVendor && $existingVendor->trashed()) {
            $existingVendor->restore();
            $existingVendor->update($validatedData);

            return redirect()->route('vendors.index')->with('success', 'Vendor ' . $validatedData['name'] . ' berhasil dipulihkan dan telah diperbarui.');
        }

        Vendor::create($validatedData);

        return redirect()->route('vendors.index')->with('success', 'Berhasil menambahkan vendor ' . $validatedData['name'] . '.');
    }

    private function validateVendor(Request $request, $id = null)
    {
        $rules = [
            'code' => [
                'required',
                'string',
                'min:2',
                'max:16',
                'alpha_num',
                Rule::unique('m_vendors', 'code')->ignore($id)->whereNull('deleted_at'),
            ],
            'name' => 'required|string|max:255|min:2',
            'address' => 'nullable|string',
            'phone' => [
                'nullable',
                'string',
                'regex:/^(0|\+62|62)[0-9]{8,14}$/',
            ],
            'email' => 'nullable|email',
        ];

        $messages = [
            'code.required' => 'Kode vendor wajib diisi!',
            'code.unique' => 'Kode vendor sudah digunakan, silakan gunakan kode lain.',
            'code.min' => 'Silakan masukkan minimal 2 karakter untuk kode vendor.',
            'code.max' => 'Silakan masukkan maksimal 16 karakter untuk kode vendor.',
            'code.alpha_num' => 'Kode vendor hanya boleh berisi huruf dan angka.',
            'name.required' => 'Nama vendor wajib diisi!',
            'name.min' => 'Silakan masukkan minimal 2 karakter untuk nama vendor.',
            'name.max' => 'Silakan masukkan maksimal 255 karakter untuk nama vendor.',
            'address.string' => 'Alamat vendor harus berupa teks.',
            'phone.string' => 'Nomor telepon vendor harus berupa teks.',
            'phone.regex' => 'Nomor telepon harus diawali dengan 0, +62, atau 62, dan hanya boleh berisi angka dengan panjang 9-15 digit.',
            'email.email' => 'Format email tidak valid.',
        ];

        $email = $request->email;
        if ($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw ValidationException::withMessages(['email' => 'Silakan isi email dengan format yang benar.']);
            }
        }

        $phone = $request->phone;
        if ($phone) {
            if (!preg_match('/^[0-9\-\+]{9,15}$/', $phone)) {
                throw ValidationException::withMessages(['phone' => 'Silakan isi nomor telepon dengan panjang 9-15 karakter, dan hanya boleh berisi angka, tanda +, dan tanda -']);
            }
        }

        return $request->validate($rules, $messages);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('master.vendors.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('master.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validatedData = $this->validateVendor($request, $vendor->id);
        $vendor->update($validatedData);

        return redirect()->route('vendors.index')->with('success', 'Berhasil memperbarui vendor ' . $validatedData['name'] . '.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Berhasil menghapus vendor ' . $vendor->name . '.');
    }
}
