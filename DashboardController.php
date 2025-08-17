<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Mood;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        // Today’s Tasks
        $todaysTasks = Task::where('user_id', $user->id)
            ->whereDate('due_date', $today)
            ->get();

        // Today’s Mood
        $todaysMood = Mood::where('user_id', $user->id)
            ->whereDate('date', $today)
            ->first();

        // Motivational Quote
        $messages = [
            "You're doing great!",
            "Keep pushing!",
            "One step at a time!",
            "Progress over perfection.",
            "You’ve got this!"
        ];
        $quote = $messages[array_rand($messages)];

        return view('dashboard', compact('todaysTasks', 'todaysMood', 'quote'));
    }

    public function weeklySummary()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $sevenDaysAgo = $today->copy()->subDays(6);

        // Completed Tasks this Week
        $weeklyCompletedTasks = Task::where('user_id', $user->id)
            ->whereBetween('due_date', [$sevenDaysAgo, $today])
            ->where('is_completed', true)
            ->orderBy('due_date', 'asc')
            ->get();

        // Weekly Moods
        $weeklyMoods = Mood::where('user_id', $user->id)
            ->whereBetween('date', [$sevenDaysAgo, $today])
            ->orderBy('date', 'asc')
            ->get();

        return view('weekly-summary', compact('weeklyCompletedTasks', 'weeklyMoods'));
    }
}
