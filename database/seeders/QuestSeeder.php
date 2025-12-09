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
            'name' => 'Stroomvreter',
            'description' => 'De stroomvreter bestrijden is essentieel! Het sluipverbruik in de klas zorgt voor onnodige CO2-uitstoot, wat klimaatverandering versnelt en de natuurgebieden van Natuurmonumenten beschadigt. Door één stekker uit het stopcontact te halen, bescherm jij de natuur direct, bespaar je de school geld én word je een groene held voor je klasgenoten en thuis.',
            'difficulty_level' => 1,
            'category' => QuestCategory::NATURE,
            'is_active' => true,
        ])->parts()->createMany([
            [
                'order_index' => 1,
                'name' => 'Doel?',
                'description' => 'Kijk nu 60 seconden lang rond in je klas. Zoek naar alles wat stroom verspilt zonder nut: opladers in het stopcontact, monitors op stand-by (rood of oranje lampje), of luidsprekers die onnodig aanstaan.',
                'media_url' => null,
                'success_condition' => 'timer:60s',
            ],
            [
                'order_index' => 2,
                'name' => 'Check!',
                'description' => 'Type hieronder wat je allemaal hebt gevonden in je klaslokaal en hebt uitgezet! Wanneer je alles hebt ingevuld, klik dan op Check.',
                'media_url' => null,
                'success_condition' => 'input',
            ],
            [
                'order_index' => 3,
                'name' => 'Voldaan!',
                'description' => 'Je hebt de eerste missie voltooid en de Stroomvreter is verslagen! Je hebt direct impact gemaakt. Jouw actie zorgt ervoor dat jullie virtuele, gloednieuwe natuurgebied verbetert.',
                'media_url' => null,
                'success_condition' => 'done',
            ],
        ]);
        Quest::create([
            'name' => 'Natuur Trivia',
            'description' => 'Natuur Trivia test je inzicht in habitats. Door een plek te zien, weet je direct welk dier daar thuishoort en waarom de plek belangrijk is.',
            'difficulty_level' => 2,
            'category' => QuestCategory::NATURE,
            'is_active' => true,
        ])->parts()->createMany([
            [
                'order_index' => 1,
                'name' => 'Doel',
                'description' => 'Je staat in een open, zanderig gebied aan de kust. Er staan weinig bomen, maar vooral lage struikjes en droge grassoorten. Het is er vaak winderig en er zijn veel zandduinen. Welk dier is hier de baas?',
                'media_url' => null,
                'success_condition' => 'multiple:Bever (Bouwt dammen),Konijn (Graaft tunnels),Wild Zwijn (Woelt in bossen),Fuut (Watervogel):1'
            ],
            [
                'order_index' => 2,
                'name' => 'Voldaan!',
                'description' => 'Konijn is het juiste antwoord! Ze zijn perfect in het graven van burchten in de zanderige duingrond. Ze eten de lage planten die daar groeien en houden zo de duinen open. Hierdoor is het Konijn superbelangrijk voor de balans van het duinlandschap!',
                'media_url' => null,
                'success_condition' => 'done',
            ],
        ]);
    }
}
