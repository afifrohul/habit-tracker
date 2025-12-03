<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\RedirectController;

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
    });

});

require __DIR__.'/settings.php';
