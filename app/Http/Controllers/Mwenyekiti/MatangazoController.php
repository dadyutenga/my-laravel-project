<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\MatangazoYaKawaida;
use App\Models\MtaaMeeting;
use App\Models\Matangazo;
use App\Models\Mwenyekiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MatangazoController extends Controller
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

        // Get both types of announcements
        $generalAnnouncements = MatangazoYaKawaida::with('createdBy')
            ->where('created_by', $mwenyekitiId)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'general_page');

        $meetingAnnouncements = Matangazo::with(['mtaaMeeting', 'createdBy'])
            ->where('created_by', $mwenyekitiId)
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'meeting_page');

        // Statistics
        $totalGeneral = MatangazoYaKawaida::where('created_by', $mwenyekitiId)->count();
        $totalMeeting = Matangazo::where('created_by', $mwenyekitiId)->count();
        $activeGeneral = MatangazoYaKawaida::where('created_by', $mwenyekitiId)
            ->active()->current()->count();
        $urgentGeneral = MatangazoYaKawaida::where('created_by', $mwenyekitiId)
            ->urgent()->count();

        return view('Mwenyekiti.Matangazo.index', compact(
            'generalAnnouncements',
            'meetingAnnouncements', 
            'totalGeneral',
            'totalMeeting',
            'activeGeneral',
            'urgentGeneral'
        ));
    }

    public function create()
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        // Get available meetings for meeting announcements
        $availableMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('meeting_date', '>=', now())
            ->orderBy('meeting_date', 'asc')
            ->get();

        return view('Mwenyekiti.Matangazo.create', compact('availableMeetings'));
    }

    public function store(Request $request)
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        $request->validate([
            'announcement_type' => 'required|in:general,meeting',
            'title' => 'required|string|max:255',
            'title_sw' => 'required|string|max:255',
            'content' => 'required|string|min:10',
            'content_sw' => 'nullable|string',
            'category' => 'required_if:announcement_type,general|string',
            'priority' => 'required_if:announcement_type,general|in:low,normal,high,urgent',
            'target_audience' => 'required_if:announcement_type,general|string',
            'mtaa' => 'required|string|max:100',
            'effective_date' => 'nullable|date|after_or_equal:today',
            'expiry_date' => 'nullable|date|after:effective_date',
            'is_featured' => 'boolean',
            'send_notification' => 'boolean',
            'mtaa_meeting_id' => 'required_if:announcement_type,meeting|exists:mtaa_meetings,id',
            'attachments.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120', // 5MB max
        ]);

        try {
            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('matangazo-attachments', 'public');
                    $attachments[] = [
                        'name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'size' => $file->getSize(),
                        'type' => $file->getClientMimeType(),
                    ];
                }
            }

            if ($request->announcement_type === 'general') {
                // Create general announcement
                MatangazoYaKawaida::create([
                    'created_by' => $mwenyekitiId,
                    'title' => $request->title,
                    'title_sw' => $request->title_sw,
                    'content' => $request->content,
                    'content_sw' => $request->content_sw,
                    'category' => $request->category,
                    'priority' => $request->priority,
                    'target_audience' => $request->target_audience,
                    'mtaa' => $request->mtaa,
                    'effective_date' => $request->effective_date,
                    'expiry_date' => $request->expiry_date,
                    'is_featured' => $request->boolean('is_featured'),
                    'send_notification' => $request->boolean('send_notification', true),
                    'attachments' => $attachments,
                ]);

                $message = 'General announcement created successfully!';
            } else {
                // Create meeting announcement
                Matangazo::create([
                    'mtaa_meeting_id' => $request->mtaa_meeting_id,
                    'created_by' => $mwenyekitiId,
                    'title' => $request->title,
                    'title_sw' => $request->title_sw,
                    'content' => $request->content,
                    'content_sw' => $request->content_sw,
                    'mtaa' => $request->mtaa,
                    'attachments' => $attachments,
                ]);

                $message = 'Meeting announcement created successfully!';
            }

            return redirect()->route('mwenyekiti.matangazo.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create announcement: ' . $e->getMessage());
        }
    }

    public function show($id, $type = 'general')
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        if ($type === 'general') {
            $announcement = MatangazoYaKawaida::with('createdBy')
                ->where('created_by', $mwenyekitiId)
                ->findOrFail($id);
        } else {
            $announcement = Matangazo::with(['mtaaMeeting', 'createdBy'])
                ->where('created_by', $mwenyekitiId)
                ->findOrFail($id);
        }

        return view('Mwenyekiti.Matangazo.show', compact('announcement', 'type'));
    }

    public function edit($id, $type = 'general')
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        if ($type === 'general') {
            $announcement = MatangazoYaKawaida::where('created_by', $mwenyekitiId)->findOrFail($id);
        } else {
            $announcement = Matangazo::where('created_by', $mwenyekitiId)->findOrFail($id);
        }

        $availableMeetings = MtaaMeeting::where('organizer_id', $mwenyekitiId)
            ->where('meeting_date', '>=', now())
            ->orderBy('meeting_date', 'asc')
            ->get();

        return view('Mwenyekiti.Matangazo.edit', compact('announcement', 'type', 'availableMeetings'));
    }

    public function destroy($id, $type = 'general')
    {
        $mwenyekitiId = $this->getMwenyekitiId();
        
        if (!$mwenyekitiId) {
            return redirect()->route('login1')->with('error', 'Please login first');
        }

        try {
            if ($type === 'general') {
                $announcement = MatangazoYaKawaida::where('created_by', $mwenyekitiId)->findOrFail($id);
            } else {
                $announcement = Matangazo::where('created_by', $mwenyekitiId)->findOrFail($id);
            }

            // Delete attachments from storage
            if (!empty($announcement->attachments)) {
                foreach ($announcement->attachments as $attachment) {
                    Storage::disk('public')->delete($attachment['path']);
                }
            }

            $announcement->delete();

            return redirect()->route('mwenyekiti.matangazo.index')
                ->with('success', 'Announcement deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete announcement: ' . $e->getMessage());
        }
    }
}