<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HabitController;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('welcome', [RedirectController::class, 'index']);
    
    Route::middleware(['role:admin'])->group(function () {
        Route::get('back-dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin-dashboard');
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
        Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
        Route::get('/habits/create', [HabitController::class, 'create'])->name('habits.create');
        Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
        Route::get('/habits/{id}/edit', [HabitController::class, 'edit'])->name('habits.edit');
        Route::put('/habits/{id}', [HabitController::class, 'update'])->name('habits.update');
        Route::delete('/habits/{id}', [HabitController::class, 'destroy'])->name('habits.destroy');
        Route::get('/habits', [HabitController::class, 'index'])->name('habits.index');
    });

});

require __DIR__.'/settings.php';
