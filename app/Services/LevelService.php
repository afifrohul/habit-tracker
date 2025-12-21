<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserGameStat;
use Illuminate\Support\Facades\DB;

class LevelService
{
    protected int $baseExp = 50;
    protected float $multiplier = 1.15;

    public function addExp(User $user, int $expGain): void
    {
        DB::transaction(function () use ($user, $expGain) {

            $stats = $user->profileStat; // relasi 1:1

            // fallback safety
            if (!$stats) {
                $stats = UserGameStat::create([
                    'user_id'    => $user->id,
                    'level'      => 1,
                    'level_exp'  => 0,
                    'total_exp'  => 0,
                ]);
            }

            // tambah EXP
            $stats->total_exp += $expGain;
            $stats->level_exp += $expGain;

            // cek level up (bisa multi level)
            while ($stats->level_exp >= $this->expToNextLevel($stats->level)) {
                $needed = $this->expToNextLevel($stats->level);

                $stats->level++;
                $stats->level_exp -= $needed;
            }

            $stats->save();
        });
    }

    public function expToNextLevel(int $level): int
    {
        return (int) floor(
            $this->baseExp * pow($this->multiplier, $level - 1)
        );
    }
}
