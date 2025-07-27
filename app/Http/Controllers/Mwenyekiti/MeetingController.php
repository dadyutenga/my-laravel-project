<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MtaaMeeting;
use App\Models\Mwenyekiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    public function index()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meetings = MtaaMeeting::with('organizer')
            ->where('organizer_id', $mwenyekitiId)
            ->orderBy('meeting_date', 'desc')
            ->paginate(10);

        // Statistics for dashboard
        $totalMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)->count();
        $thisMonthMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->whereMonth('meeting_date', now()->month)
            ->whereYear('meeting_date', now()->year)
            ->count();
        $completedMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->whereNotNull('outcome')
            ->count();
        $upcomingMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('meeting_date', '>', now())
            ->whereNull('outcome')
            ->count();

        return view('Mwenyekiti.Meeting.index', compact(
            'meetings',
            'totalMeetings',
            'thisMonthMeetings',
            'completedMeetings',
            'upcomingMeetings'
        ));
    }

    public function create()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        return view('Mwenyekiti.Meeting.create');
    }

    public function store(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'title_sw' => 'required|string|max:255',
            'agenda' => 'required|string|min:10',
            'meeting_date' => 'required|date|after_or_equal:today',
            'mtaa' => 'required|string|max:100',
        ]);

        MtaaMeeting::create([
            'title' => $request->title,
            'title_sw' => $request->title_sw,
            'agenda' => $request->agenda,
            'meeting_date' => $request->meeting_date,
            'mtaa' => $request->mtaa,
            'organizer_id' => $mwenyekitiId,
        ]);

        return redirect()->route('mwenyekiti.meetings.index')
            ->with('success', 'Meeting scheduled successfully!');
    }

    public function show($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meeting = MtaaMeeting::with('organizer')
            ->where('organizer_id', $mwenyekitiId)
            ->findOrFail($id);

        return view('Mwenyekiti.Meeting.show', compact('meeting'));
    }

    public function edit($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meeting = MtaaMeeting::where('organizer_id', $mwenyekitiId)->findOrFail($id);

        return view('Mwenyekiti.Meeting.edit', compact('meeting'));
    }

    public function update(Request $request, $id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meeting = MtaaMeeting::where('organizer_id', $mwenyekitiId)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'title_sw' => 'required|string|max:255',
            'agenda' => 'required|string|min:10',
            'meeting_date' => 'required|date',
            'mtaa' => 'required|string|max:100',
            'outcome' => 'nullable|string|min:10',
        ]);

        $meeting->update([
            'title' => $request->title,
            'title_sw' => $request->title_sw,
            'agenda' => $request->agenda,
            'meeting_date' => $request->meeting_date,
            'mtaa' => $request->mtaa,
            'outcome' => $request->outcome,
        ]);

        return redirect()->route('mwenyekiti.meetings.show', $meeting->id)
            ->with('success', 'Meeting updated successfully!');
    }

    public function recordOutcome(Request $request, $id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meeting = MtaaMeeting::where('organizer_id', $mwenyekitiId)->findOrFail($id);

        $request->validate([
            'outcome' => 'required|string|min:20|max:2000',
        ]);

        $meeting->update([
            'outcome' => $request->outcome,
        ]);

        return redirect()->route('mwenyekiti.meetings.show', $meeting->id)
            ->with('success', 'Meeting outcome recorded successfully!');
    }

    public function destroy($id)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $meeting = MtaaMeeting::where('organizer_id', $mwenyekitiId)->findOrFail($id);
        
        // Only allow deletion if meeting hasn't happened yet or has no outcome
        if ($meeting->meeting_date <= now() && $meeting->outcome) {
            return redirect()->route('mwenyekiti.meetings.index')
                ->with('error', 'Cannot delete a completed meeting with recorded outcome.');
        }

        $meeting->delete();

        return redirect()->route('mwenyekiti.meetings.index')
            ->with('success', 'Meeting deleted successfully!');
    }
}