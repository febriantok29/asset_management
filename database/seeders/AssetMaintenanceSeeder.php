<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction\AssetMaintenance;

class AssetMaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetMaintenance::factory()->count(10)->create();
    }
}
