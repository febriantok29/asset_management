<?php

namespace Database\Factories\Transaction;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Master\Asset;
use App\Models\Master\Vendor;
use App\Models\Transaction\AssetPurchase;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction\AssetPurchase>
 */
class AssetPurchaseFactory extends Factory
{
    protected $model = AssetPurchase::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $purchaseDate = $this->faker->date();
        $currentDate = date('Y/m/d', strtotime($purchaseDate));

        return [
            'purchase_code' => $currentDate . '-AP' . $this->faker->unique()->numberBetween(100, 999),
            'asset_id' => Asset::factory(),
            'vendor_id' => Vendor::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'purchase_date' => $purchaseDate,
            'total_cost' => $this->faker->numberBetween(5000, 999999999),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
