<?php

namespace App\Observers;

use App\Models\HabitLog;
use App\Services\LevelService;

class HabitLogObserver
{
    public function created(HabitLog $habitLog): void
    {
        app(LevelService::class)
            ->addExp($habitLog->user, $habitLog->exp_gain);
    }

    public function deleted(HabitLog $habitLog): void
    {
        app(LevelService::class)
            ->removeExp($habitLog->user, $habitLog->exp_gain);
    }
}
