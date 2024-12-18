<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::factory()->count(10)->create();
    }
}
