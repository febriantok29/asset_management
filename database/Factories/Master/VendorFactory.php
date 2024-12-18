<?php

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Master\Vendor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VendorFactory extends Factory
{
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $prefixVendor = ['PT', 'CV', 'UD', 'PD', 'TB', 'Koperasi', 'Perumahan', 'Corp', 'Co', 'Ltd', 'Inc', 'Tbk', 'Persero'];

        $vendorName = $this->faker->randomElement($prefixVendor) . ' ' . $this->faker->name;

        return [
            'code' => $this->faker->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'name' => $vendorName,
            'phone' => substr($this->faker->e164PhoneNumber, 0, 15),
            'email' => $this->faker->email,
            'address' => $this->faker->streetAddress,
        ];
    }
}
