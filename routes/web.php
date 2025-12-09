<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
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
    Route::post('/profile/groups/join', [ProfileController::class, 'joinGroup'])->name('profile.groups.join');
    Route::delete('/profile/groups/{group}', [ProfileController::class, 'leaveGroup'])->name('profile.groups.leave');

    // Homepage route.
    Route::get('/', [NatureParkController::class, 'slideshow'])->name('home');

    // Quests route.
    Route::resource('/nature', NatureParkController::class)
        ->only('show');
    Route::get('/nature/{naturePark}/quests', [NatureParkController::class, 'quests'])
        ->name('nature.quests');
    Route::resource('/groups.quests.parts', PartController::class)
        ->only(['show']);
});

Route::middleware(['auth', 'teacher'])->group(function () {
    // Group management routes for teachers and admins.
    Route::resource('/groups', GroupController::class)
        ->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->withoutMiddlewareFor('show', 'teacher');

    // Manage users within a group.
    Route::patch('/groups/{group}/users/{user}/role', [GroupController::class, 'updateUserRole'])
        ->name('groups.users.update-role');
    Route::delete('/groups/{group}/users/{user}', [GroupController::class, 'removeUser'])
        ->name('groups.users.remove');
    Route::post('/groups/{group}/users', [GroupController::class, 'addUser'])
        ->name('groups.users.add')
        ->middleware('admin');

    // Generate and delete group codes.
    Route::post('/groups/{group}/code/generate', [GroupController::class, 'codeGenerate'])
        ->name('groups.code.generate');
    Route::delete('/groups/{group}/code', [GroupController::class, 'deleteCode'])
        ->name('groups.code.delete');

    // Nature park management routes for teachers and admins.
    Route::resource('/nature', NatureParkController::class)
        ->only(['create', 'store', 'show', 'edit', 'update', 'destroy'])
        ->withoutMiddlewareFor('show', 'teacher');

    // quest management for teachers.
    Route::resource('/groups.quests', QuestController::class)
        ->only(['show']);
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('/groups', GroupController::class)
        ->only('index');
    Route::resource('/nature', NatureParkController::class)
        ->only('index');
    Route::get('/', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users.index');
    Route::patch('/users/{user}/role', [AdminController::class, 'changeUserRole'])->name('admin.users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Quest management for admins.
    Route::resource('/quests', QuestController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('/quests.parts', PartController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__ . '/auth.php';
