<?php

namespace App\Http\Controllers\User;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\HabitLog;

class TrackerController extends Controller
{
    public function index()
    {
        try {
            $logs = HabitLog::with(['habit'])->where('user_id', auth()->user()->id)
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'title' => $log->habit->name,
                    'start' => $log->date,
                    'end' => $log->date,
                    'extendedProps' => [
                        'icon' => $log->habit->icon,
                        'color' => $log->habit->color
                    ]
                ];
            });



            return Inertia::render('user/tracker/index', compact('logs'));
        } catch (\Exception $e) {
            Log::error('Error loading logs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load logs.');
        }
    }
}
