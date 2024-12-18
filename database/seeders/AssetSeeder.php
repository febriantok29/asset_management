<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Asset;

class AssetSeeder extends Seeder
{
    public function run()
    {
        Asset::factory()->count(10)->create();
    }
}
