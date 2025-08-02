<?php

namespace App\Http\Controllers\Balozi;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketBaloziController extends Controller
{
    /**
     * Get the ID of the currently logged-in Balozi from session or Auth
     */
    protected function getBaloziId()
    {
        $baloziId = session('balozi_id');
        if (!$baloziId && Auth::check()) {
            $baloziId = Auth::user()->balozi_id;
        }
        
        if (!$baloziId) {
            return redirect()->route('login')->with('error', 'Unauthorized. Please login again.');
        }
        
        return $baloziId;
    }

    /**
     * Display a listing of the tickets
     */
    public function index(Request $request)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $query = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                        ->where('user_id', $baloziId)
                        ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('ticket_number', 'like', '%' . $request->search . '%');
            });
        }

        $tickets = $query->paginate(10);

        return view('Balozi.Ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket
     */
    public function create()
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        return view('Balozi.Ticket.create');
    }

    /**
     * Store a newly created ticket
     */
    public function store(Request $request)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'category' => 'required|string|max:100',
            'attachments' => 'nullable|array|max:5',
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120', // 5MB max
            'tags' => 'nullable|string'
        ]);

        // Handle file uploads
        $attachmentPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('ticket-attachments', 'public');
                $attachmentPaths[] = [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ];
            }
        }

        // Process tags
        $tags = [];
        if ($validated['tags']) {
            $tags = array_map('trim', explode(',', $validated['tags']));
            $tags = array_filter($tags); // Remove empty tags
        }

        $ticket = Tickets::create([
            'ticket_number' => Tickets::generateTicketNumber(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'category' => $validated['category'],
            'status' => Tickets::STATUS_OPEN,
            'user_type' => Tickets::USER_TYPE_BALOZI,
            'user_id' => $baloziId,
            'attachments' => $attachmentPaths,
            'tags' => $tags
        ]);

        return redirect()->route('balozi.tickets.show', $ticket->id)
                        ->with('success', 'Tiketi imesajiliwa kikamilifu! Nambari ya tiketi: ' . $ticket->ticket_number);
    }

    /**
     * Display the specified ticket
     */
    public function show($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $ticket = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                         ->where('user_id', $baloziId)
                         ->findOrFail($id);

        return view('Balozi.Ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified ticket
     */
    public function edit($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $ticket = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                         ->where('user_id', $baloziId)
                         ->findOrFail($id);

        // Only allow editing if ticket is open
        if (!$ticket->isOpen()) {
            return redirect()->route('balozi.tickets.show', $ticket->id)
                            ->with('error', 'Huwezi kubadilisha tiketi ambayo tayari imeshaanza kushughulikiwa.');
        }

        return view('Balozi.Ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified ticket
     */
    public function update(Request $request, $id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $ticket = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                         ->where('user_id', $baloziId)
                         ->findOrFail($id);

        // Only allow updating if ticket is open
        if (!$ticket->isOpen()) {
            return redirect()->route('balozi.tickets.show', $ticket->id)
                            ->with('error', 'Huwezi kubadilisha tiketi ambayo tayari imeshaanza kushughulikiwa.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'category' => 'required|string|max:100',
            'new_attachments' => 'nullable|array|max:5',
            'new_attachments.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
            'tags' => 'nullable|string'
        ]);

        // Handle new file uploads
        $existingAttachments = $ticket->attachments ?? [];
        if ($request->hasFile('new_attachments')) {
            foreach ($request->file('new_attachments') as $file) {
                $path = $file->store('ticket-attachments', 'public');
                $existingAttachments[] = [
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ];
            }
        }

        // Process tags
        $tags = [];
        if ($validated['tags']) {
            $tags = array_map('trim', explode(',', $validated['tags']));
            $tags = array_filter($tags);
        }

        $ticket->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'category' => $validated['category'],
            'attachments' => $existingAttachments,
            'tags' => $tags
        ]);

        return redirect()->route('balozi.tickets.show', $ticket->id)
                        ->with('success', 'Tiketi imebadilishwa kikamilifu!');
    }

    /**
     * Remove the specified ticket
     */
    public function destroy($id)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $ticket = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                         ->where('user_id', $baloziId)
                         ->findOrFail($id);

        // Only allow deletion if ticket is open
        if (!$ticket->isOpen()) {
            return redirect()->route('balozi.tickets.show', $ticket->id)
                            ->with('error', 'Huwezi kufuta tiketi ambayo tayari imeshaanza kushughulikiwa.');
        }

        // Delete attachments from storage
        if ($ticket->attachments) {
            foreach ($ticket->attachments as $attachment) {
                Storage::disk('public')->delete($attachment['path']);
            }
        }

        $ticket->delete();

        return redirect()->route('balozi.tickets.index')
                        ->with('success', 'Tiketi imefutwa kikamilifu.');
    }

    /**
     * Download attachment
     */
    public function downloadAttachment($ticketId, $attachmentIndex)
    {
        $baloziId = $this->getBaloziId();
        if ($baloziId instanceof \Illuminate\Http\RedirectResponse) {
            return $baloziId;
        }

        $ticket = Tickets::where('user_type', Tickets::USER_TYPE_BALOZI)
                         ->where('user_id', $baloziId)
                         ->findOrFail($ticketId);

        if (!isset($ticket->attachments[$attachmentIndex])) {
            abort(404, 'Attachment not found');
        }

        $attachment = $ticket->attachments[$attachmentIndex];
        
        if (!Storage::disk('public')->exists($attachment['path'])) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download(
            $attachment['path'], 
            $attachment['original_name']
        );
    }
}