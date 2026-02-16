<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectName = fake()->unique()->words(2, true);

        return [
            'public_id' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'name' => Str::title($projectName),
            'slug' => Str::slug($projectName),
            'description' => fake()->sentence(),
        ];
    }
}
