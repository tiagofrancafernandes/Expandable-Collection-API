<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InitialUserSeeder extends Seeder
{
    /**
     * Seed required initial users and baseline project data.
     */
    public function run(): void
    {
        $superAdminUser = $this->upsertUser(
            'Super Admin',
            'admin@mail.com'
        );
        $superAdminUser->syncRoles(['super-admin']);

        $tenantUserWithData = $this->upsertUser(
            'User One',
            'user1@mail.com'
        );
        $tenantUserWithData->syncRoles(['tenant-user']);

        $tenantUserEmpty = $this->upsertUser(
            'User Two',
            'user2@mail.com'
        );
        $tenantUserEmpty->syncRoles(['tenant-user']);

        $project = Project::query()->firstOrCreate(
            [
                'user_id' => $tenantUserWithData->id,
                'slug' => 'default-project',
            ],
            [
                'public_id' => (string) Str::uuid(),
                'name' => 'Default Project',
                'description' => 'Initial seeded project for user1.',
            ]
        );

        Collection::query()->firstOrCreate(
            [
                'project_id' => $project->id,
                'slug' => 'posts',
            ],
            [
                'public_id' => (string) Str::uuid(),
                'name' => 'Posts',
                'description' => 'Sample posts collection.',
                'schema' => [
                    [
                        'name' => 'id',
                        'type' => 'uuid',
                        'nullable' => false,
                        'generated' => 'uuid4',
                    ],
                    [
                        'name' => 'title',
                        'type' => 'string',
                        'nullable' => false,
                    ],
                    [
                        'name' => 'published',
                        'type' => 'boolean',
                        'nullable' => false,
                        'default' => false,
                    ],
                ],
                'is_media_collection' => false,
            ]
        );
    }

    private function upsertUser(string $name, string $email): User
    {
        return User::query()->updateOrCreate(
            [
                'email' => $email,
            ],
            [
                'name' => $name,
                'password' => Hash::make('power@123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
