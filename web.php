<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotivationQuoteController;
use App\Http\Controllers\FocusModeController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\MotivationalVideoController;
use App\Http\Controllers\FocusMusicController;
use App\Http\Controllers\InspirationalImageController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class)->only(['index', 'create', 'store', 'update', 'destroy']);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('moods', MoodController::class)->except(['show', 'create']);
    
});
Route::middleware(['auth'])->group(function () {
    Route::resource('journals', JournalController::class)->except(['show']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/weekly-summary', [DashboardController::class, 'weeklySummary'])->name('weekly.summary');
});
Route::middleware(['auth'])->group(function () {
    

    Route::get('/motivation', [MotivationQuoteController::class, 'index'])->name('motivation.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/focus', [FocusModeController::class, 'index'])->name('focus.index');
    Route::post('/focus/set/{task}', [FocusModeController::class, 'setFocus'])->name('focus.set');
    Route::post('/focus/start/{task}', [FocusModeController::class, 'startPomodoro'])->name('focus.start');
    Route::post('/focus/complete/{task}', [FocusModeController::class, 'markComplete'])->name('focus.complete');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    Route::get('/habits/create', [HabitController::class, 'create'])->name('habits.create');
    Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
    Route::get('/habits/{id}/edit', [HabitController::class, 'edit'])->name('habits.edit');
    Route::put('/habits/{id}', [HabitController::class, 'update'])->name('habits.update');
    Route::delete('/habits/{id}', [HabitController::class, 'destroy'])->name('habits.destroy');
    Route::patch('/habits/{id}/complete', [HabitController::class, 'complete'])->name('habits.complete');
});
Route::get('/motivational-videos', [MotivationalVideoController::class, 'index'])->name('videos.index');

Route::get('/focus-music', [FocusMusicController::class, 'index'])->name('focus_music.index')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::get('/inspirational-image', [InspirationalImageController::class, 'index'])->name('inspirational-image.index');
});

require __DIR__.'/auth.php';
