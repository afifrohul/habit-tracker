<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Habit;
use App\Models\Category;
use App\Models\HabitLog;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $user = User::findOrFail(auth()->user()->id);

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

        $expGainByCategory = HabitLog::query()
            ->join('habits', 'habit_logs.habit_id', '=', 'habits.id')
            ->join('categories', 'habits.category_id', '=', 'categories.id')
            ->whereNull('habit_logs.deleted_at')
            ->where('habit_logs.user_id', auth()->user()->id)
            ->select(
                'categories.name as category',
                \DB::raw('CAST(SUM(habit_logs.exp_gain) AS UNSIGNED) as exp_gain')
            )
            ->groupBy('categories.name')
            ->get();


        $expGainByHabit = HabitLog::query()
            ->join('habits', 'habit_logs.habit_id', '=', 'habits.id')
            ->whereNull('habit_logs.deleted_at')
            ->where('habit_logs.user_id', auth()->user()->id)
            ->select(
                'habits.name as habit',
                \DB::raw('CAST(SUM(habit_logs.exp_gain) AS UNSIGNED) as exp_gain')
            )
            ->groupBy('habits.name')
            ->get();


        return Inertia::render('user/dashboard', compact(
            'user',
            'categoryCount',
            'habitCount',
            'habitLogCount',
            'expTotal',
            'chartData',
            'expGainByCategory',
            'expGainByHabit'
        ));
    }
}
