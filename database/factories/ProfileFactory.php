<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Profile::class;

    public function definition()
    {
        return [
            'firstname' => fake()->firstName(),
            'middlename' => 'waived',
            'lastname' => fake()->lastName(),
            'suffix' => null,
            'division_id' => '1',
            'section_id' => '2',
            'user_id' => User::factory(),
            'position' => fake()->jobTitle(),
            'status' => 'active',
            // 'position' => fake(),
        ];
    }
}
