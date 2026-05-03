<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Placeholder routes for frontend development
    Route::get('/mood', function () { return view('mood'); })->name('mood');
    Route::get('/encyclopedia', function () { return view('encyclopedia.index'); })->name('encyclopedia.index');
    Route::get('/encyclopedia/cemas', function () { return view('encyclopedia.show'); })->name('encyclopedia.show');
    Route::get('/journal', function () { return view('journal.index'); })->name('journal.index');
    Route::get('/journal/1', function () { return view('journal.show'); })->name('journal.show');
});

require __DIR__.'/auth.php';
