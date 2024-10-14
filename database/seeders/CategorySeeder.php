<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Master\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan beberapa data dummy untuk kategori
        Category::create([
            'name' => 'Electronics',
            'description' => 'All kinds of electronic devices'
        ]);

        Category::create([
            'name' => 'Furniture',
            'description' => 'Various furniture for home and office'
        ]);

        Category::create([
            'name' => 'Stationery',
            'description' => 'All kinds of office and school supplies'
        ]);

        Category::create([
            'name' => 'Food & Beverages',
            'description' => 'Food, drinks, and other consumables'
        ]);
    }
}
