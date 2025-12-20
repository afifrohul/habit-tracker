<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Models\Habit;
use App\Models\Category;
use App\Models\HabitLog;

class HabitLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {


            if ($request->input('date')) {
                $date = $request->input('date');
            } else {
                $date = now()->format('Y-m-d');
            }

            $habits = Habit::where('user_id', auth()->user()->id)->get();
            $logs = HabitLog::with(['habit.category'])->where('user_id', auth()->user()->id)->where('date', $date)->get();
            return Inertia::render('user/log/index', [
                'logs' => $logs,
                'selectedDate' => $date,
                'habits' => $habits
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading logs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load logs.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'habit_id' => 'required',
            'date' => 'required'
        ]);

        try {

            $habit = Habit::findOrFail($validated['habit_id']);

            $validated['user_id'] = auth()->user()->id;
            $validated['exp_gain'] = $habit->difficulty === 'easy' ? 5 : ($habit->difficulty === 'medium' ? 10 : 20);

            HabitLog::create($validated);

            return redirect()->back()->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            Log::error('Error storing category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $log = HabitLog::findOrFail($id);
            $log->delete();

            return redirect()->back()->with('success', 'Log deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting log: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete log.');
        }
    }
}
