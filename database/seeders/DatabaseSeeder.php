<?php

namespace Database\Seeders;

use App\Enums\GroupRole;
use App\Enums\Role;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed quests and parts
        $this->call([
            QuestSeeder::class,
        ]);

        // Create admin user with global admin role
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password123!',
            'role' => Role::ADMIN,
        ]);

        // Create a group
        $group = Group::factory()->create([
            'name' => 'Schoolgroep NaN',
            'description' => 'Een schoolgroep die de natuurparken bezoekt.',
        ]);

        // Create teacher user with teacher role
        $leraar = User::factory()->create([
            'name' => 'leraar',
            'email' => 'leraar@example.com',
            'password' => 'password123!',
            'role' => Role::TEACHER,
        ]);

        // Create student user with user role
        $leerling = User::factory()->create([
            'name' => 'leerling',
            'email' => 'leerling@example.com',
            'password' => 'password123!',
            'role' => Role::USER,
        ]);

        // Attach users to group with proper group roles
        $group->users()->attach($leraar->id, ['role' => GroupRole::OWNER]);
        $group->users()->attach($leerling->id, ['role' => GroupRole::MEMBER]);
    }
}
