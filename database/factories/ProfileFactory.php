<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Profile;
use App\Models\Section;
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
        $division = Division::inRandomOrder()->first();

        // Get a section that belongs to the selected division
        $section = Section::where('division_id', $division->id)->inRandomOrder()->first();
        return [
            'firstname' => fake()->firstName(),
            'middlename' => 'waived',
            'lastname' => fake()->lastName(),
            'suffix' => null,
            'division_id' => $division->id,
            'section_id' => $section ? $section->id : null,
            'user_id' => User::factory(),
            'position' => fake()->jobTitle(),
            'status' => 'active',
            // 'position' => fake(),
        ];
    }
}
