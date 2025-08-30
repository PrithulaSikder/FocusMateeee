<?php



namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HabitController extends Controller
{
    // Show all habits for logged-in user
    public function index()
    {
        $habits = Habit::where('user_id', Auth::id())
                       ->orderBy('habit_date', 'desc')
                       ->get();

        return view('habits.index', compact('habits'));
    }

    // Show create form
    public function create()
    {
        return view('habits.create');
    }

    // Store new habit
    public function store(Request $request)
    {
        $request->validate([
            'habit_name' => 'required|string|max:255',
            'habit_date' => 'required|date',
        ]);

        Habit::create([
            'user_id' => Auth::id(),
            'habit_name' => $request->habit_name,
            'habit_date' => $request->habit_date,
            'is_completed' => false,
        ]);

        return redirect()->route('habits.index')->with('success', 'Habit added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        return view('habits.edit', compact('habit'));
    }

    // Update habit
    public function update(Request $request, $id)
    {
        $request->validate([
            'habit_name' => 'required|string|max:255',
            'habit_date' => 'required|date',
            'is_completed' => 'nullable|boolean',
        ]);

        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);

        $habit->update([
            'habit_name' => $request->habit_name,
            'habit_date' => $request->habit_date,
            'is_completed' => $request->has('is_completed'),
        ]);

        return redirect()->route('habits.index')->with('success', 'Habit updated successfully!');
    }

    // Delete habit
    public function destroy($id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        $habit->delete();

        return redirect()->route('habits.index')->with('success', 'Habit deleted successfully!');
    }

    // Mark as completed
    public function complete($id)
    {
        $habit = Habit::where('user_id', Auth::id())->findOrFail($id);
        $habit->update(['is_completed' => true]);

        return redirect()->route('habits.index')->with('success', 'Habit marked as completed!');
    }
}

