<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmotionController;
use App\Http\Controllers\EncyclopediaController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminEncyclopediaController;
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

Route::middleware(['auth'])->group(function () {
    // ── Routes Accessible to All Authenticated Users ─────────────────────────

    // Dashboard (User can see this even if not verified)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile Settings (User needs access to verify email or change info)
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    // ── Routes Requiring Email Verification ──────────────────────────────────
    Route::middleware(['verified'])->group(function () {

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

        // Upload inline images for Tiptap editor
        Route::post('/journal/upload-image', [JournalController::class, 'uploadImage'])
            ->name('journal.uploadImage');

        Route::resource('journal', JournalController::class)->except(['destroy']);

        // Soft-delete (POST method to avoid JS dependency for DELETE)
        Route::delete('/journal/{journal}', [JournalController::class, 'destroy'])
            ->name('journal.destroy');

        // ── Encyclopedia of Feelings ──────────────────────────────────────────────

        Route::get('/encyclopedia', [EncyclopediaController::class, 'index'])
            ->name('encyclopedia.index');

        Route::get('/encyclopedia/{encyclopedia}', [EncyclopediaController::class, 'show'])
            ->name('encyclopedia.show');
    });
});

// ─────────────────────────────────────────────────────────────────────────────
// Auth Routes (login, register, password reset, etc.)
// ─────────────────────────────────────────────────────────────────────────────

require __DIR__ . '/auth.php';

// ─────────────────────────────────────────────────────────────────────────────
// Admin Dummy Routes (For Frontend UI Testing)
// ─────────────────────────────────────────────────────────────────────────────

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.auth.login');
    })->name('admin.login');

    Route::get('/dashboard', function () {
        // Dummy data for dashboard chart
        $moodTrend = collect(range(1, 30))->map(function ($day) {
            return [
                'date' => now()->subDays(30 - $day)->format('Y-m-d'),
                'avg_score' => rand(2, 5), // Random score between 2 and 5
            ];
        });

        return view('admin.dashboard', compact('moodTrend'));
    })->name('admin.dashboard');

    Route::get('/encyclopedia', function () {
        return view('admin.encyclopedia.index');
    })->name('admin.encyclopedia.index');

    Route::get('/encyclopedia/create', function () {
        return view('admin.encyclopedia.create');
    })->name('admin.encyclopedia.create');
});

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::post('/logout',[AdminAuthController::class, 'logout'])->name('logout');

        // ── Admin Protected ───────────────────────────────────────────────────────
        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::resource('encyclopedia', AdminEncyclopediaController::class)->names('encyclopedia');
        });
    });
