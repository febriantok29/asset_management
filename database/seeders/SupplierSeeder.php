<?php

namespace Database\Seeders;

use App\Models\Master\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data supplier secara otomatis
        Supplier::create([
            'name' => 'Supplier A',
            'email' => 'supplierA@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Raya No. 1, Jakarta',
        ]);

        Supplier::create([
            'name' => 'Supplier B',
            'email' => 'supplierB@example.com',
            'phone' => '081987654321',
            'address' => 'Jl. Merdeka No. 2, Bandung',
        ]);

        Supplier::create([
            'name' => 'Supplier C',
            'email' => 'supplierC@example.com',
            'phone' => '081345678912',
            'address' => 'Jl. Pahlawan No. 3, Surabaya',
        ]);
    }
}
