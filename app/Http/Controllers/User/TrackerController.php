<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\HabitLog;
use App\Models\Habit;
use Carbon\Carbon;

class TrackerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user = auth()->user();

            $userHabits = Habit::where('user_id', $user->id)->pluck('id')->toArray();

            $filterHabits = $request->input('habits', $userHabits);

            $validHabitIds = array_intersect($filterHabits, $userHabits);

            if (empty($validHabitIds)) {
                $validHabitIds = $userHabits;
            }

            $logs = HabitLog::with('habit')
                ->where('user_id', $user->id)
                ->whereIn('habit_id', $validHabitIds)
                ->get()
                ->map(fn($log) => [
                    'id' => $log->id,
                    'title' => $log->habit->name,
                    'start' => $log->date,
                    'end' => $log->date,
                    'extendedProps' => [
                        'icon' => $log->habit->icon,
                        'color' => $log->habit->color,
                    ],
                ]);

            $habits = Habit::where('user_id', $user->id)
                ->select('id', 'name', 'icon', 'color')
                ->get();

            $categories = Category::with(['habits'])->where('user_id', $user->id)->get();

            $start = now()->subDays(6)->startOfDay();
            $end = now()->endOfDay();

            $weeklyLog = HabitLog::where('user_id', $user->id)
                ->whereBetween('date', [$start, $end])
                ->get()
                ->groupBy('habit_id');
            
            $dates = collect(range(0, 6))->map(function ($i) {
                $date = now()->subDays(6 - $i);
                return [
                    'key' => $date->format('Y-m-d'),
                    'label' => $date->format('d M'),
                ];
            });

            $chartData = HabitLog::where('user_id', $user->id)
            ->select(\DB::raw('date, count(*) as habit'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            return Inertia::render('user/tracker/index', compact(
                'logs',
                'habits', 
                'validHabitIds',
                'categories',
                'weeklyLog',
                'dates',
                'chartData'
            ));

        } catch (\Exception $e) {
            Log::error('Error loading logs: ' . $e->getMessage());
            return back()->with('error', 'Failed to load logs.');
        }
    }

    public function show($id)
    {
        try {

            $habit = Habit::with(['category', 'logs'])->findOrFail($id);

            $data = HabitLog::where('user_id', auth()->user()->id)->where('habit_id', $id)->get();

            $chartData = collect($data)
                ->groupBy(function ($item) {
                    return Carbon::parse($item['date'])->format('Y-m');
                })
                ->map(function ($items, $ym) {
                    $date = Carbon::parse($ym . '-01');

                    return [
                        'year'  => $date->year,
                        'month' => $date->format('F'),
                        'habit' => $items->count(),
                    ];
                })
                ->values();

            $gridData = collect($data)
                ->map(fn($log) => [
                    'id' => $log->id,
                    'year' => Carbon::parse($log->date)->format('Y'),
                    'date' => $log->date
                ]);

            $uniqueYears = collect($chartData)
            ->pluck('year')
            ->unique()
            ->values();

            return Inertia::render('user/tracker/show', compact(
                'habit',
                'chartData',
                'uniqueYears',
                'gridData'
            ));

        } catch (\Exception $e) {
            Log::error('Error loading habit tracker: ' . $e->getMessage());
            return back()->with('error', 'Failed to load habit tracker.');
        }   
    }
}
