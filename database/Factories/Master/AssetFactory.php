<?php

namespace Database\Factories\Master;

use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use App\Models\Master\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AssetFactory extends Factory
{
    protected $model = Asset::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'name' => $this->faker->name,
            'stock' => $this->faker->numberBetween(1, 100),
            'category_id' => Category::factory(),
            'vendor_id' => Vendor::factory(),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
