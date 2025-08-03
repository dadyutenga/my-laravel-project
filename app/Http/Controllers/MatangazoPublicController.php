<?php

namespace App\Http\Controllers;

use App\Models\MatangazoYaKawaida ;
use App\Models\Matangazo;
use App\Models\MtaaMeeting;
use Illuminate\Http\Request;

class MatangazoPublicController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $category = $request->get('category');
        $priority = $request->get('priority');
        $mtaa = $request->get('mtaa');
        $type = $request->get('type', 'all');
        $search = $request->get('search');

        // Get general announcements (PUBLIC only)
        $generalQuery = Matangazoyakawaida ::with('createdBy')
            ->where('status', 'active')
            ->where(function($q) {
                $q->whereNull('expiry_date')
                  ->orWhere('expiry_date', '>=', now()->toDateString());
            })
            ->orderBy('created_at', 'desc');

        // Get meeting announcements
        $meetingQuery = Matangazo::with(['mtaaMeeting', 'createdBy'])
            ->whereHas('mtaaMeeting', function($q) {
                $q->where('meeting_date', '>=', now());
            })
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($search) {
            $generalQuery->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        if ($category) {
            $generalQuery->where('category', $category);
        }

        if ($priority) {
            $generalQuery->where('priority', $priority);
        }

        if ($mtaa) {
            $generalQuery->where('mtaa', $mtaa);
        }

        // Get announcements
        $generalAnnouncements = collect();
        $meetingAnnouncements = collect();

        if ($type === 'all' || $type === 'general') {
            $generalAnnouncements = $generalQuery->paginate(10);
        }

        if ($type === 'all' || $type === 'meeting') {
            $meetingAnnouncements = $meetingQuery->paginate(10);
        }

        // Get categories and mtaa for filters
        $categories = Matangazoyakawaida ::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        $availableMtaa = Matangazoyakawaida ::select('mtaa')
            ->distinct()
            ->whereNotNull('mtaa')
            ->pluck('mtaa');

        return view('Matangazo', compact(
            'generalAnnouncements',
            'meetingAnnouncements',
            'categories',
            'availableMtaa',
            'category',
            'priority',
            'mtaa',
            'type',
            'search'
        ));
    }

    public function show($id, $type = 'general')
    {
        if ($type === 'general') {
            $announcement = Matangazoyakawaida ::with('createdBy')->findOrFail($id);
        } else {
            $announcement = Matangazo::with(['mtaaMeeting', 'createdBy'])->findOrFail($id);
        }

        return view('Matangazo', compact('announcement', 'type'));
    }
}