<?php

namespace App\Http\Controllers;

use App\Models\MatangazoYaKawaida;
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
        $type = $request->get('type', 'all'); // all, general, meeting

        // Base queries
        $generalQuery = MatangazoYaKawaida::with('createdBy')
            ->active()
            ->current()
            ->orderBy('priority', 'desc')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc');

        $meetingQuery = Matangazo::with(['mtaaMeeting', 'createdBy'])
            ->whereHas('mtaaMeeting', function($q) {
                $q->where('meeting_date', '>=', now());
            })
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($category) {
            $generalQuery->byCategory($category);
        }

        if ($priority) {
            $generalQuery->byPriority($priority);
        }

        if ($mtaa) {
            $generalQuery->forMtaa($mtaa);
            $meetingQuery->whereHas('mtaaMeeting', function($q) use ($mtaa) {
                $q->where('mtaa', $mtaa);
            });
        }

        // Get announcements based on type filter
        $generalAnnouncements = collect();
        $meetingAnnouncements = collect();

        if ($type === 'all' || $type === 'general') {
            $generalAnnouncements = $generalQuery->paginate(10, ['*'], 'general_page');
        }

        if ($type === 'all' || $type === 'meeting') {
            $meetingAnnouncements = $meetingQuery->paginate(10, ['*'], 'meeting_page');
        }

        // Get featured announcements for sidebar
        $featuredAnnouncements = MatangazoYaKawaida::featured()
            ->active()
            ->current()
            ->limit(5)
            ->get();

        // Get urgent announcements
        $urgentAnnouncements = MatangazoYaKawaida::urgent()
            ->active()
            ->current()
            ->limit(3)
            ->get();

        // Get available categories and mtaa for filters
        $categories = MatangazoYaKawaida::select('category')
            ->distinct()
            ->active()
            ->pluck('category');

        $availableMtaa = MatangazoYaKawaida::select('mtaa')
            ->distinct()
            ->active()
            ->pluck('mtaa');

        return view('Matangazo', compact(
            'generalAnnouncements',
            'meetingAnnouncements',
            'featuredAnnouncements',
            'urgentAnnouncements',
            'categories',
            'availableMtaa',
            'category',
            'priority',
            'mtaa',
            'type'
        ));
    }

    public function show($id, $type = 'general')
    {
        if ($type === 'general') {
            $announcement = MatangazoYaKawaida::with('createdBy')
                ->active()
                ->findOrFail($id);
            
            // Increment views
            $announcement->incrementViews();
        } else {
            $announcement = Matangazo::with(['mtaaMeeting', 'createdBy'])
                ->findOrFail($id);
        }

        // Get related announcements
        $relatedAnnouncements = MatangazoYaKawaida::active()
            ->current()
            ->where('id', '!=', $id)
            ->limit(5)
            ->get();

        return view('matangazo-detail', compact('announcement', 'type', 'relatedAnnouncements'));
    }

    public function downloadAttachment($id, $type, $attachmentIndex)
    {
        if ($type === 'general') {
            $announcement = MatangazoYaKawaida::findOrFail($id);
        } else {
            $announcement = Matangazo::findOrFail($id);
        }

        $attachments = $announcement->attachments ?? [];
        
        if (!isset($attachments[$attachmentIndex])) {
            abort(404, 'Attachment not found');
        }

        $attachment = $attachments[$attachmentIndex];
        $filePath = storage_path('app/public/' . $attachment['path']);

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        return response()->download($filePath, $attachment['name']);
    }
}