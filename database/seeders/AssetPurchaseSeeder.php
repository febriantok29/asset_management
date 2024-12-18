<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction\AssetPurchase;

class AssetPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetPurchase::factory()->count(10)->create();
    }
}
