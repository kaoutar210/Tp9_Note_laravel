<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Speaker;
use App\Models\Participant;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantsExport;
use App\Imports\ParticipantsImport;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $events = Event::where('title', 'like', "%{$search}%")
                          ->orWhere('location', 'like', "%{$search}%")
                          ->get();
        } else {
            $events = Event::all();
        }

        return view('events.index', [
            'events' => $events,
            'search' => $search
        ]);
    }

    public function create()
    {
        $speakers = Speaker::all();
        return view('events.create', [
            'speakers' => $speakers
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);

        $event = Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $validated['location'],
            'image' => $validated['image'],
            'client_id' => 1,
        ]);

        if ($request->has('speakers')) {
            foreach ($request->speakers as $index => $speakerId) {
                if ($speakerId) {
                    $topic = $request->topics[$index] ?? 'Non spécifié';
                    $event->speakers()->attach($speakerId, [
                        'topic' => $topic,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        $allParticipants = Participant::all();
        return view('events.show', [
            'event' => $event,
            'allParticipants' => $allParticipants
        ]);
    }

    public function edit(Event $event)
    {
        $speakers = Speaker::all();
        return view('events.edit', [
            'event' => $event,
            'speakers' => $speakers
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);

        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'location' => $validated['location'],
            'image' => $validated['image'],
        ]);

        $event->speakers()->detach();
        if ($request->has('speakers')) {
            foreach ($request->speakers as $index => $speakerId) {
                if ($speakerId) {
                    $topic = $request->topics[$index] ?? 'Non spécifié';
                    $event->speakers()->attach($speakerId, [
                        'topic' => $topic,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        return redirect()->route('events.show', $event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index');
    }

    public function addParticipant(Request $request, Event $event)
    {
        $validated = $request->validate([
            'participant_id' => 'required|exists:participants,id',
        ]);

        $event->participants()->attach($validated['participant_id'], [
            'registered_at' => now()
        ]);

        return redirect()->route('events.show', $event);
    }

    public function generatePdf(Event $event)
    {
        $pdf = PDF::loadView('events.pdf', [
            'event' => $event
        ]);
        
        return $pdf->download('event-' . $event->id . '.pdf');
    }

    public function exportParticipants(Event $event)
    {
        return Excel::download(new ParticipantsExport($event), 'participants-event-' . $event->id . '.xlsx');
    }

    public function importParticipants(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ParticipantsImport($event), $request->file('file'));

        return redirect()->route('events.show', $event);
    }
}