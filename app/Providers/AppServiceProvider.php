<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\HabitLog;
use App\Observers\HabitLogObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        HabitLog::observe(HabitLogObserver::class);
    }
}
