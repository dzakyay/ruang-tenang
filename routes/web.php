<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\EncyclopediaController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────────────────────────────────────
// Public Routes
// ─────────────────────────────────────────────────────────────────────────────

Route::get('/', function () {
    return view('landing');
});

// ─────────────────────────────────────────────────────────────────────────────
// Authenticated & Verified Routes
// ─────────────────────────────────────────────────────────────────────────────

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ── Mood / Emotion ────────────────────────────────────────────────────────

    // Analytics & calendar page
    Route::get('/mood', [EmotionController::class, 'index'])
        ->name('mood');

    // Store mood from dashboard modal or mood page
    Route::post('/mood', [EmotionController::class, 'store'])
        ->name('mood.store');

    // JSON endpoint for Chart.js (accepts ?days=7 or ?days=30)
    Route::get('/mood/chart-data', [EmotionController::class, 'chartData'])
        ->name('mood.chart-data');

    // ── Journal ───────────────────────────────────────────────────────────────

    Route::resource('journal', JournalController::class)->except(['destroy']);

    // Soft-delete (POST method to avoid JS dependency for DELETE)
    Route::delete('/journal/{journal}', [JournalController::class, 'destroy'])
        ->name('journal.destroy');

    // ── Encyclopedia of Feelings ──────────────────────────────────────────────

    Route::get('/encyclopedia', [EncyclopediaController::class, 'index'])
        ->name('encyclopedia.index');

    Route::get('/encyclopedia/{encyclopedia}', [EncyclopediaController::class, 'show'])
        ->name('encyclopedia.show');

    // ── Profile ───────────────────────────────────────────────────────────────

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// ─────────────────────────────────────────────────────────────────────────────
// Auth Routes (login, register, password reset, etc.)
// ─────────────────────────────────────────────────────────────────────────────

require __DIR__ . '/auth.php';
