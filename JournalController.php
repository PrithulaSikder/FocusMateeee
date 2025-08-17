<?php



namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())
                           ->orderBy('date', 'desc')
                           ->get();
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entry' => 'required|string',
        ]);

        $existing = Journal::where('user_id', Auth::id())
                           ->whereDate('date', now()->toDateString())
                           ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You already wrote a journal today 📝');
        }

        Journal::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'entry' => $request->entry,
        ]);

        return redirect()->route('journals.index')->with('success', 'Journal saved successfully!');
    }

    public function edit(Journal $journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }

        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'entry' => 'required|string',
        ]);

        $journal->update(['entry' => $request->entry]);

        return redirect()->route('journals.index')->with('success', 'Journal updated!');
    }

    public function destroy(Journal $journal)
    {
        if ($journal->user_id !== Auth::id()) {
            abort(403);
        }

        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Journal deleted.');
    }
}
