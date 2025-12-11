<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Habit;
use App\Models\Category;
use App\Models\HabitLog;

class DashboardController extends Controller
{
    public function index()
    {
        $categoryCount = Category::where('user_id', auth()->user()->id)->count();
        $habitCount = Habit::where('user_id', auth()->user()->id)->count();
        $habitLogCount = HabitLog::where('user_id', auth()->user()->id)->count();
        $expTotal = HabitLog::where('user_id', auth()->user()->id)
            ->select(\DB::raw('sum(exp_gain) as exp'))
            ->first()->exp;

        $chartData = HabitLog::where('user_id', auth()->user()->id)
            ->select(\DB::raw('date, sum(exp_gain) as exp'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return Inertia::render('user/dashboard', compact(
            'categoryCount',
            'habitCount',
            'habitLogCount',
            'expTotal',
            'chartData'
        ));
    }
}
