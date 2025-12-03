<?php

namespace Database\Seeders;

use App\Enums\QuestCategory;
use App\Models\Quest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create "Missie Stroomvreter" quest
        Quest::create([
            'name' => 'Missie Stroomvreter',
            'description' => 'De stroomvreter bestrijden is essentieel! Het sluipverbruik in de klas zorgt voor onnodige CO2-uitstoot, wat klimaatverandering versnelt en de natuurgebieden van Natuurmonumenten beschadigt. Door één stekker uit het stopcontact te halen, bescherm jij de natuur direct, bespaar je de school geld én word je een groene held voor je klasgenoten en thuis.',
            'difficulty_level' => 1,
            'category' => QuestCategory::NATURE,
            'is_active' => true,
        ])->parts()->createMany([
            [
                'order_index' => 1,
                'name' => 'Wat moet je doen?',
                'description' => 'Kijk nu 60 seconden lang rond in je klas. Zoek naar alles wat stroom verspilt zonder nut: opladers in het stopcontact, monitors op stand-by (rood of oranje lampje), of luidsprekers die onnodig aanstaan.',
                'media_url' => null,
                'success_condition' => 'timer:60s',
            ],
            [
                'order_index' => 2,
                'name' => 'Registratie',
                'description' => 'Type hieronder wat je allemaal hebt gevonden in je klaslokaal en hebt uitgezet! Wanneer je alles hebt ingevuld, klik dan op volgende.',
                'media_url' => null,
                'success_condition' => 'textField',
            ],
            [
                'order_index' => 3,
                'name' => 'Voldaan',
                'description' => 'Voldaan! Je hebt de eerste missie voltooid en de Stroomvreter is verslagen! Je hebt direct impact gemaakt: jouw actie zorgt ervoor dat jullie virtuele, gloednieuwe natuurgebied verbetert! Check de ranglijst om te zien hoe goed jullie het doen. Veel plezier! Vergeet niet om elke dag zelf nog quests uit te voeren en groen gedrag te blijven vertonen!',
                'media_url' => null,
                'success_condition' => 'button',
            ],
        ]);
    }
}
