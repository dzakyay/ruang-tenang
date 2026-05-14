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

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');


    Route::middleware(['verified'])->group(function () {

        Route::get('/mood', [EmotionController::class, 'index'])
            ->name('mood');

        Route::post('/mood', [EmotionController::class, 'store'])
            ->name('mood.store');

        Route::get('/mood/chart-data', [EmotionController::class, 'chartData'])
            ->name('mood.chart-data');

        Route::post('/journal/upload-image', [JournalController::class, 'uploadImage'])
            ->name('journal.uploadImage');

        Route::resource('journal', JournalController::class)->except(['destroy']);

        Route::delete('/journal/{journal}', [JournalController::class, 'destroy'])
            ->name('journal.destroy');

        Route::get('/encyclopedia', [EncyclopediaController::class, 'index'])
            ->name('encyclopedia.index');

        Route::get('/encyclopedia/{encyclopedia}', [EncyclopediaController::class, 'show'])
            ->name('encyclopedia.show');
    });
});

require __DIR__ . '/auth.php';

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login',  [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
        Route::post('/logout',[AdminAuthController::class, 'logout'])->name('logout');

        Route::middleware(['auth', 'admin'])->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::resource('encyclopedia', AdminEncyclopediaController::class)
                ->names('encyclopedia')
                ->parameters(['encyclopedia' => 'encyclopedia']);
        });
    });
