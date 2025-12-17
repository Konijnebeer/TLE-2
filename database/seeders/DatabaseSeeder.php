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
            'name' => 'De Regenboog H1A',
            'description' => 'Leren en ondersteuning met plezier!',
        ]);

        $group2 = Group::factory()->create([
            'name' => 'Helinium V1W',
            'description' => 'Heel uniek, net als jij!'
        ]);

        $group3 = Group::factory()->create([
            'name' => 'Leerfabriek H1B',
            'description' => 'Leren bovenop!'
        ]);

        $group4 = Group::factory()->create([
            'name' => 'Waterlelie V2A',
            'description' => 'Spetter spetter spat...'
        ]);

        $group5 = Group::factory()->create([
            'name' => 'Middelbaar H1V',
            'description' => 'Gewoon een middelbare...'
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
        $naturePark->increment('state', 1);

        $naturePark2 = $group2->naturePark;
        $naturePark2->increment('state', 4);
        $naturePark3 = $group3->naturePark;
        $naturePark3->increment('state', 2);

        $naturePark4 = $group4->naturePark;
        $naturePark5 = $group5->naturePark;

        // Get the first part from the first quest
        $firstPartFirstQuest = Part::where('quest_id', 1)->orderBy('order_index')->first();
        $firstPartSecondQuest = Part::where('quest_id', 2)->orderBy('order_index')->first();
        $firstPartThirdQuest = Part::where('quest_id', 3)->orderBy('order_index')->first();

        if ($firstPartFirstQuest && $firstPartSecondQuest && $naturePark) {
            $naturePark->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
            $naturePark->parts()->attach($firstPartThirdQuest->id, ['status' => 'pending']);

            $naturePark2->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark2->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
            $naturePark2->parts()->attach($firstPartThirdQuest->id, ['status' => 'pending']);

            $naturePark3->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark3->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
            $naturePark3->parts()->attach($firstPartThirdQuest->id, ['status' => 'pending']);

            $naturePark4->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark4->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
            $naturePark4->parts()->attach($firstPartThirdQuest->id, ['status' => 'pending']);

            $naturePark5->parts()->attach($firstPartFirstQuest->id, ['status' => 'pending']);
            $naturePark5->parts()->attach($firstPartSecondQuest->id, ['status' => 'pending']);
            $naturePark5->parts()->attach($firstPartThirdQuest->id, ['status' => 'pending']);
        }
    }
}
