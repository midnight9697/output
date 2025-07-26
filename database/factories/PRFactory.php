<?php

namespace Database\Factories;

use App\Models\PurchaseRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PRFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = PurchaseRequest::class;

    public function definition()
    {
        return [
            'entity_name' => "EMB 8",
            'fund_cluster' => "101 - Planning",
            'office' => "PISMU",
            'pr_number' => "waived",
            'responsibility_center_code' => fake()->countryCode(),
            'purpose' => fake()->macAddress(),
            'created_by' => 1,
        ];
    }
}
