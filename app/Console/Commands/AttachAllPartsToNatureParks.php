<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NaturePark;
use App\Models\Part;

class AttachAllPartsToNatureParks extends Command
{
    protected $signature = 'natureparks:attach-all-parts';
    protected $description = 'Attach all existing parts to all nature parks with status pending, if not already attached.';

    public function handle()
    {
        $natureParks = NaturePark::all();
        $parts = Part::all();
        $count = 0;

        foreach ($natureParks as $naturePark) {
            foreach ($parts as $part) {
                // Only attach if not already attached
                if (!$naturePark->parts()->where('parts.id', $part->id)->exists()) {
                    $naturePark->parts()->attach($part->id, ['status' => 'pending']);
                    $count++;
                }
            }
        }
        $this->info("Attached $count missing part-nature park links.");
        return 0;
    }
}

