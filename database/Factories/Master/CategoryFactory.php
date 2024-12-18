<?php

namespace Database\Factories\Master;

use App\Models\Master\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefixes = ['Perlengkapan', 'Komponen', 'Perangkat', 'Aksesoris', 'Software', 'Hardware', 'Jaringan', 'Server', 'Penyimpanan', 'Berkas'];
        $suffixes = ['IT', 'Kantor', 'Pribadi', 'Umum', 'Khusus', 'Lainnya'];

        return [
            'code' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'name' => $this->faker->randomElement($prefixes) . ' ' . $this->faker->randomElement($suffixes),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
