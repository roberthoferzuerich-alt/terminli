<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PollController extends Controller
{
    public function index()
    {
        $polls = auth()->user()->polls()->with(['options', 'participants'])->latest()->get();

        return view('dashboard', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'meeting_url' => 'nullable|string',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string',
        ]);

        $poll = auth()->user()->polls()->create([
            'uuid' => (string) Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'meeting_url' => $request->meeting_url,
        ]);

        foreach ($request->options as $optionLabel) {
            if (! empty(trim($optionLabel))) {
                $poll->options()->create([
                    'label' => trim($optionLabel),
                ]);
            }
        }

        return redirect()->route('polls.show', $poll->uuid)->with('success', 'Umfrage erfolgreich erstellt!');
    }

    public function show($uuid)
    {
        $poll = Poll::with(['options', 'participants.votes'])->where('uuid', $uuid)->firstOrFail();

        return view('polls.show', compact('poll'));
    }

    public function storeVote(Request $request, $uuid)
    {
        $poll = Poll::where('uuid', $uuid)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'votes' => 'required|array',
        ]);

        $participant = $poll->participants()->create([
            'name' => $request->name,
            'edit_token' => (string) Str::uuid(),
        ]);

        foreach ($request->votes as $optionId => $response) {
            $participant->votes()->create([
                'poll_option_id' => $optionId,
                'response' => $response, // 'yes', 'no', 'maybe'
            ]);
        }

        return redirect()->route('polls.show', ['uuid' => $uuid, 'edit_token' => $participant->edit_token])->with('success', 'Deine Stimme wurde gespeichert!')->with('edit_token', $participant->edit_token);
    }

    public function updateVote(Request $request, string $uuid, string $editToken)
    {
        $poll = Poll::where('uuid', $uuid)->firstOrFail();
        $participant = $poll->participants()->where('edit_token', $editToken)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'votes' => 'required|array',
        ]);

        $participant->update([
            'name' => $request->name,
        ]);

        foreach ($request->votes as $optionId => $response) {
            $participant->votes()->updateOrCreate(
                ['poll_option_id' => $optionId],
                ['response' => $response]
            );
        }

        return redirect()->route('polls.show', ['uuid' => $uuid, 'edit_token' => $editToken])->with('success', 'Deine Stimme wurde aktualisiert!')->with('edit_token', $editToken);
    }

    public function destroy(string $uuid)
    {
        $poll = auth()->user()->polls()->where('uuid', $uuid)->firstOrFail();
        $poll->delete();

        return redirect()->route('dashboard')->with('success', 'Umfrage erfolgreich gelöscht!');
    }
}
