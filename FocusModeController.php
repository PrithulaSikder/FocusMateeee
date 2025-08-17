<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FocusModeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // first, try to get current focus task
        $focusTask = Task::where('user_id', $user->id)->where('is_focus', true)->first();

        // if not set, pick the first incomplete task (by due_date)
        if (! $focusTask) {
            $focusTask = Task::where('user_id', $user->id)
                             ->where('is_completed', false)
                             ->orderBy('due_date', 'asc')
                             ->first();
        }

        return view('focus.index', compact('focusTask'));
    }

    public function setFocus(Task $task)
    {
        // ensure owner
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        // clear other focus flags for this user
        Task::where('user_id', Auth::id())->update(['is_focus' => false]);

        // set focus
        $task->update(['is_focus' => true]);

        return redirect()->route('focus.index')->with('success', 'Focus set to "' . $task->title . '"');
    }

    public function startPomodoro(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'duration' => 'required|integer|min:1|max:480' // up to 8 hours
        ]);

        // store current time and duration (minutes)
        $task->update([
            'pomodoro_start' => Carbon::now()->format('H:i:s'),
            'pomodoro_duration' => $request->duration,
            'is_focus' => true, // ensure task becomes focused
        ]);

        return redirect()->route('focus.index')->with('success', 'Pomodoro started for "' . $task->title . '"');
    }

    public function markComplete(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->update([
            'is_completed' => true,
            'is_focus' => false,
            'pomodoro_start' => null,
            'pomodoro_duration' => null
        ]);

        return redirect()->route('focus.index')->with('success', 'Task marked complete.');
    }
}
