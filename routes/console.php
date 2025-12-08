<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Group;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('codes:expire', function () {
    $expiredCount = Group::where('code_expires_at', '<=', now())
        ->whereNotNull('code')
        ->update([
            'code' => null,
            'code_expires_at' => null
        ]);

    $this->info("Expired {$expiredCount} class code(s)");
})->purpose('Manually expire all class codes that have passed their expiration date')->everyMinute()->withoutOverlapping();
