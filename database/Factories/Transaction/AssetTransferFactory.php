<?php

namespace Database\Factories\Transaction;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Master\Asset;
use App\Models\Master\AssetLocation;
use App\Models\Transaction\AssetTransfer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction\AssetTransfer>
 */
class AssetTransferFactory extends Factory
{
    protected $model = AssetTransfer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = $this->faker->date();
        $transferDate = date('Y/m/d', strtotime($randomDate));

        return [
            'transfer_code' => $transferDate . '-AT' . $this->faker->unique()->numberBetween(100, 999),
            'asset_id' => Asset::factory(),
            'from_location_id' => AssetLocation::factory(),
            'to_location_id' => AssetLocation::factory(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'transfer_date' => $transferDate,
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
