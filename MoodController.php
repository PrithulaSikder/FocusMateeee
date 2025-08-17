<?php


namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = now()->toDateString();

        // Get today's mood (if exists)
        $todaysMood = Mood::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        // Get all moods for the user sorted descending by date
        $moods = Mood::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();

        return view('moods.index', compact('moods', 'todaysMood'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|in:happy,neutral,sad,anxious,angry',
        ]);

        $user = Auth::user();
        $today = now()->toDateString();

        $existingMood = Mood::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if ($existingMood) {
            return redirect()->route('moods.index')->with('error', "Sorry {$user->name}, you can add only one mood per day 😩");
        }

        Mood::create([
            'user_id' => $user->id,
            'mood' => $request->mood,
            'date' => $today,
        ]);

        return redirect()->route('moods.index')->with('success', 'Mood added successfully!');
    }

    public function update(Request $request, Mood $mood)
    {
        $user = Auth::user();
        if ($mood->user_id !== $user->id) {
            abort(403);
        }

        $request->validate([
            'mood' => 'required|in:happy,neutral,sad,anxious,angry',
        ]);

        // Only allow update for today's mood
        if ($mood->date != now()->toDateString()) {
            return redirect()->route('moods.index')->with('error', 'You can only update today’s mood.');
        }

        $mood->update(['mood' => $request->mood]);

        return redirect()->route('moods.index')->with('success', 'Mood updated successfully!');
    }

    public function destroy(Mood $mood)
    {
        $user = Auth::user();
        if ($mood->user_id !== $user->id) {
            abort(403);
        }

        $mood->delete();

        return redirect()->route('moods.index')->with('success', 'Mood deleted!');
    }
}
       