<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction\AssetTransfer;

class AssetTransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetTransfer::factory()->count(10)->create();
    }
}
