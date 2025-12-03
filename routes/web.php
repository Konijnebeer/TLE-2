<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\NatureParkController;
use Illuminate\Support\Facades\Route;

// Redirect default dashboard URI to homepage, as we are not using default dashboard.
Route::permanentRedirect('/dashboard', '/')->name('dashboard');

Route::middleware('auth')->group(function () {
    // Default Breeze profile routes.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Homepage route.
    Route::get('/', [NatureParkController::class, 'slideshow'])->name('home');
    // Quests route.
    Route::resource('/quests', QuestController::class);
    Route::resource('/quests.parts',PartController::class);
});

require __DIR__ . '/auth.php';
