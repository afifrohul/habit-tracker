<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileStat extends Model
{
    protected $fillable = ['user_id', 'level', 'level_exp', 'total_exp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
