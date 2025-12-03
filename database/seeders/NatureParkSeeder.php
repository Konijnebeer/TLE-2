<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\NaturePark;
use App\Models\Quest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NatureParkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the group and quest
        $group = Group::where('name', 'Schoolgroep NaN')->first();
        $quest = Quest::where('name', 'Missie Stroomvreter')->first();

        if ($group && $quest) {
            // Create a nature park for the group
            $naturePark = $group->natureParks()->create([
                'state' => 0,
            ]);

            // Link all parts of the quest to the nature park with pending status
            $quest->parts->each(fn($part) => $naturePark->parts()->attach($part->id, [
                'status' => 'pending',
                'completed_at' => null,
            ]));
        }
    }
}
