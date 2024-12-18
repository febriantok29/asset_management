<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Transaction\AssetRepair;

class AssetRepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetRepair::factory()->count(10)->create();
    }
}
