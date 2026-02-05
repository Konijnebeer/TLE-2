<?php
// DEPRECATED: This command was used for one-time migration of legacy multiple-choice data.
// It is no longer needed and has been deprecated. Kept for reference only.

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NormalizeParts extends Command
{
    protected $signature = 'parts:normalize-legacy-deprecated';
    protected $description = 'DEPRECATED: normalize legacy parts - no longer used';

    public function handle()
    {
        $this->info('Deprecated command. No action taken.');
        return 0;
    }
}
