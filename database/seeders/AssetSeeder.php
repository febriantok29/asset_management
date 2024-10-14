<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Asset;

class AssetSeeder extends Seeder
{
    public function run()
    {
        Asset::create([
            'name' => 'Office Building A',
            'status' => 'active',
            'description' => 'Main office building.',
        ]);

        Asset::create([
            'name' => 'Vehicle B1234CD',
            'status' => 'maintenance',
            'description' => 'Company vehicle.',
        ]);

        Asset::create([
            'name' => 'Warehouse Z',
            'status' => 'repair',
            'description' => 'Main warehouse for storage.',
        ]);

        Asset::create([
            'name' => 'Laptop X1',
            'status' => 'broken',
            'description' => 'Employee laptop, needs replacement.',
        ]);

        Asset::create([
            'name' => 'Server Rack C',
            'status' => 'active',
            'description' => 'Primary server rack in data center.',
        ]);
    }
}
