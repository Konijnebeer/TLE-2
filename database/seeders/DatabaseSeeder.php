<?php

namespace Database\Seeders;

use App\Enums\GroupRole;
use App\Enums\Role;
use App\Models\Group;
use App\Models\Part;
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
            'name' => 'De Regenboog',
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

        // Get the nature park created by the group factory and assign the first quest part
        $naturePark = $group->naturePark;

        // Get the first part from the first quest
        $firstPartFirstQuest = Part::where('quest_id', 1)->orderBy('order_index')->first();
        $firstPartSecondQuest = Part::where('quest_id', 2)->orderBy('order_index')->first();

        if ($firstPartFirstQuest && $firstPartSecondQuest && $naturePark) {
            $naturePark->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
        }

        if ($firstPartSecondQuest && $naturePark) {
            $naturePark->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
        }

    }
}
