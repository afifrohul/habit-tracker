<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\LevelService;

class UserProfileStat extends Model
{
    protected $fillable = ['user_id', 'level', 'level_exp', 'total_exp'];

    protected $appends = ['exp_to_next_level', 'remaining_exp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getExpToNextLevelAttribute(): int
    {
        return app(LevelService::class)
            ->expToNextLevel($this->level);
    }

    public function getRemainingExpAttribute(): int
    {
        return max(0, $this->exp_to_next_level - $this->level_exp);
    }
}
