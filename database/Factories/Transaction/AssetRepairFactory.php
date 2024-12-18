<?php

namespace Database\Factories\Transaction;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Master\Asset;
use App\Models\Transaction\AssetRepair;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction\AssetRepair>
 */
class AssetRepairFactory extends Factory
{
    protected $model = AssetRepair::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = $this->faker->date();
        $repairDate = date('Y/m/d', strtotime($randomDate));
        $statues = ['PENDING', 'ONGOING', 'COMPLETED'];

        return [
            'repair_code' => $repairDate . '-AR' . $this->faker->unique()->numberBetween(100, 999),
            'asset_id' => Asset::factory(),
            'technician_name' => $this->faker->optional()->name(),
            'repair_date' => $repairDate,
            'cost' => $this->faker->optional()->randomFloat(2, 5000, 999999999),
            'issue_description' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement($statues),
        ];
    }
}
