<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $collectionName = fake()->unique()->word();

        return [
            'public_id' => (string) Str::uuid(),
            'project_id' => Project::factory(),
            'name' => Str::title($collectionName),
            'slug' => Str::slug($collectionName),
            'description' => fake()->sentence(),
            'schema' => [
                [
                    'name' => 'title',
                    'type' => 'string',
                    'nullable' => false,
                ],
            ],
            'is_media_collection' => false,
        ];
    }
}
