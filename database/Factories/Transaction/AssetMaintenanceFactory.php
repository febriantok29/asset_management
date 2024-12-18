<?php

namespace Database\Factories\Transaction;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Master\Asset;
use App\Models\Transaction\AssetMaintenance;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction\AssetMaintenance>
 */
class AssetMaintenanceFactory extends Factory
{
    protected $model = AssetMaintenance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = $this->faker->date();
        $maintenanceDate = date('Y/m/d', strtotime($randomDate));

        return [
            'maintenance_code' => $maintenanceDate . '-AM' . $this->faker->unique()->numberBetween(100, 999),
            'asset_id' => Asset::factory(),
            'maintenance_date' => $maintenanceDate,
            'issue' => $this->faker->optional()->sentence(),
            'technician' => $this->faker->optional()->name(),
            'cost' => $this->faker->optional()->randomFloat(2, 5000, 999999999),
        ];
    }
}
