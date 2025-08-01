<?php

namespace App\Http\Controllers\Mwenyekiti;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SupportController extends Controller
{
    /**
     * Get the current Mwenyekiti's ID from session
     */
    protected function getMwenyekitiId()
    {
        return session('mwenyekiti_id');
    }

    /**
     * Display a listing of support tickets
     */
    public function index(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get filters
            $status = $request->get('status');
            $priority = $request->get('priority');
            $search = $request->get('search');

            // Build query
            $query = Tickets::where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->with(['assignedAdmin' => function($query) {
                    $query->select('id', 'name', 'email');
                }]);

            // Apply filters
            if ($status) {
                $query->byStatus($status);
            }

            if ($priority) {
                $query->byPriority($priority);
            }

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%")
                      ->orWhere('ticket_number', 'like', "%{$search}%");
                });
            }

            // Get paginated results
            $tickets = $query->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->query());

            // Get statistics
            $stats = $this->getTicketStats($mwenyekitiId);

            return view('Mwenyekiti.Support.index', compact(
                'tickets',
                'stats',
                'status',
                'priority',
                'search'
            ));

        } catch (\Exception $e) {
            Log::error('Error fetching support tickets: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Show the form for creating a new support ticket
     */
    public function create()
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get available categories
            $categories = [
                'technical' => 'Tatizo la Kiufundi',
                'account' => 'Tatizo la Akaunti',
                'feature' => 'Ombi la Kipengele Kipya',
                'bug' => 'Hitilafu ya Mfumo',
                'training' => 'Mafunzo',
                'other' => 'Mengineyo'
            ];

            return view('Mwenyekiti.Support.create', compact('categories'));

        } catch (\Exception $e) {
            Log::error('Error showing support create form: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Store a newly created support ticket
     */
    public function store(Request $request)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|min:5|max:255',
                'description' => 'required|string|min:20|max:2000',
                'priority' => 'required|in:low,medium,high,urgent',
                'category' => 'required|string|max:50',
                'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,txt',
            ], [
                'title.required' => 'Kichwa cha ombi ni lazima',
                'title.min' => 'Kichwa cha ombi kinahitaji angalau herufi 5',
                'title.max' => 'Kichwa cha ombi kisipungue herufi 255',
                'description.required' => 'Maelezo ya ombi ni lazima',
                'description.min' => 'Maelezo yanahitaji angalau herufi 20',
                'description.max' => 'Maelezo yasipungue herufi 2000',
                'priority.required' => 'Kipaumbele ni lazima',
                'priority.in' => 'Kipaumbele sio sahihi',
                'category.required' => 'Kategoria ni lazima',
                'attachments.*.max' => 'Kila faili lisipungue MB 5',
                'attachments.*.mimes' => 'Aina za faili zilizoruhusiwa: JPG, PNG, PDF, DOC, DOCX, TXT',
            ]);

            // Handle file uploads
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('support_tickets', $filename, 'public');
                    
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'filename' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                    ];
                }
            }

            // Create the ticket using transaction
            $ticket = DB::transaction(function() use ($validated, $mwenyekitiId, $attachments) {
                return Tickets::create([
                    'ticket_number' => Tickets::generateTicketNumber(),
                    'title' => trim($validated['title']),
                    'description' => trim($validated['description']),
                    'priority' => $validated['priority'],
                    'category' => $validated['category'],
                    'user_type' => Tickets::USER_TYPE_MWENYEKITI,
                    'user_id' => $mwenyekitiId,
                    'status' => Tickets::STATUS_OPEN,
                    'attachments' => $attachments,
                ]);
            });

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_ticket_stats");

            Log::info('Support ticket created successfully', [
                'ticket_id' => $ticket->id,
                'ticket_number' => $ticket->ticket_number,
                'mwenyekiti_id' => $mwenyekitiId,
                'priority' => $validated['priority']
            ]);

            return redirect()->route('mwenyekiti.support.index')
                ->with('success', 'Ombi lako la msaada limehifadhiwa kikamilifu! Nambari ya ombi: ' . $ticket->ticket_number);

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error creating support ticket: ' . $e->getMessage(), [
                'mwenyekiti_id' => $mwenyekitiId ?? null,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.')
                ->withInput();
        }
    }

    /**
     * Display the specified support ticket
     */
    public function show($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get the ticket
            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->with(['assignedAdmin' => function($query) {
                    $query->select('id', 'name', 'email', 'phone');
                }])
                ->firstOrFail();

            return view('Mwenyekiti.Support.show', compact('ticket'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Support ticket not found', [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Ombi la msaada halipatikani.');

        } catch (\Exception $e) {
            Log::error('Error fetching support ticket details: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Show the form for editing the specified support ticket (only if still open)
     */
    public function edit($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get the ticket (only if it's still open)
            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->where('status', Tickets::STATUS_OPEN)
                ->firstOrFail();

            // Get available categories
            $categories = [
                'technical' => 'Tatizo la Kiufundi',
                'account' => 'Tatizo la Akaunti',
                'feature' => 'Ombi la Kipengele Kipya',
                'bug' => 'Hitilafu ya Mfumo',
                'training' => 'Mafunzo',
                'other' => 'Mengineyo'
            ];

            return view('Mwenyekiti.Support.edit', compact('ticket', 'categories'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Ombi la msaada halipatikani au halitumwezi kuhariri.');

        } catch (\Exception $e) {
            Log::error('Error showing support ticket edit form: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.');
        }
    }

    /**
     * Update the specified support ticket (only if still open)
     */
    public function update(Request $request, $id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            // Get the ticket (only if it's still open)
            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->where('status', Tickets::STATUS_OPEN)
                ->firstOrFail();

            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|min:5|max:255',
                'description' => 'required|string|min:20|max:2000',
                'priority' => 'required|in:low,medium,high,urgent',
                'category' => 'required|string|max:50',
                'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf,doc,docx,txt',
            ], [
                'title.required' => 'Kichwa cha ombi ni lazima',
                'title.min' => 'Kichwa cha ombi kinahitaji angalau herufi 5',
                'title.max' => 'Kichwa cha ombi kisipungue herufi 255',
                'description.required' => 'Maelezo ya ombi ni lazima',
                'description.min' => 'Maelezo yanahitaji angalau herufi 20',
                'description.max' => 'Maelezo yasipungue herufi 2000',
                'priority.required' => 'Kipaumbele ni lazima',
                'priority.in' => 'Kipaumbele sio sahihi',
                'category.required' => 'Kategoria ni lazima',
                'attachments.*.max' => 'Kila faili lisipungue MB 5',
                'attachments.*.mimes' => 'Aina za faili zilizoruhusiwa: JPG, PNG, PDF, DOC, DOCX, TXT',
            ]);

            // Handle new file uploads
            $existingAttachments = $ticket->attachments ?? [];
            $newAttachments = [];

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('support_tickets', $filename, 'public');
                    
                    $newAttachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'filename' => $filename,
                        'path' => $path,
                        'size' => $file->getSize(),
                        'mime_type' => $file->getMimeType(),
                    ];
                }
            }

            // Merge existing and new attachments
            $allAttachments = array_merge($existingAttachments, $newAttachments);

            // Update the ticket using transaction
            DB::transaction(function() use ($ticket, $validated, $allAttachments) {
                $ticket->update([
                    'title' => trim($validated['title']),
                    'description' => trim($validated['description']),
                    'priority' => $validated['priority'],
                    'category' => $validated['category'],
                    'attachments' => $allAttachments,
                ]);
            });

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_ticket_stats");

            Log::info('Support ticket updated successfully', [
                'ticket_id' => $ticket->id,
                'ticket_number' => $ticket->ticket_number,
                'mwenyekiti_id' => $mwenyekitiId
            ]);

            return redirect()->route('mwenyekiti.support.show', $ticket->id)
                ->with('success', 'Ombi lako la msaada limebadilishwa kikamilifu!');

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('mwenyekiti.support.index')
                ->with('error', 'Ombi la msaada halipatikani au halitumwezi kuhariri.');

        } catch (\Exception $e) {
            Log::error('Error updating support ticket: ' . $e->getMessage(), [
                'id' => $id,
                'mwenyekiti_id' => $mwenyekitiId,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo la kiufundi. Tafadhali jaribu tena.')
                ->withInput();
        }
    }

    /**
     * Remove attachment from ticket
     */
    public function removeAttachment(Request $request, $id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->where('status', Tickets::STATUS_OPEN)
                ->firstOrFail();

            $attachmentIndex = $request->get('index');
            $attachments = $ticket->attachments ?? [];

            if (isset($attachments[$attachmentIndex])) {
                // Delete file from storage
                $filePath = $attachments[$attachmentIndex]['path'] ?? null;
                if ($filePath && Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }

                // Remove from array
                unset($attachments[$attachmentIndex]);
                $attachments = array_values($attachments); // Re-index array

                // Update ticket
                $ticket->update(['attachments' => $attachments]);

                return response()->json(['success' => true]);
            }

            return response()->json(['error' => 'Attachment not found'], 404);

        } catch (\Exception $e) {
            Log::error('Error removing attachment: ' . $e->getMessage(), [
                'ticket_id' => $id,
                'attachment_index' => $request->get('index'),
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return response()->json(['error' => 'Server error'], 500);
        }
    }

    /**
     * Download attachment
     */
    public function downloadAttachment($id, $index)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->firstOrFail();

            $attachments = $ticket->attachments ?? [];

            if (!isset($attachments[$index])) {
                return redirect()->back()->with('error', 'Faili halipatikani.');
            }

            $attachment = $attachments[$index];
            $filePath = $attachment['path'];

            if (!Storage::disk('public')->exists($filePath)) {
                return redirect()->back()->with('error', 'Faili halipatikani kwenye hifadhi.');
            }

            return Storage::disk('public')->download($filePath, $attachment['original_name']);

        } catch (\Exception $e) {
            Log::error('Error downloading attachment: ' . $e->getMessage(), [
                'ticket_id' => $id,
                'attachment_index' => $index,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->back()->with('error', 'Kuna tatizo katika kupakua faili.');
        }
    }

    /**
     * Get ticket statistics
     */
    private function getTicketStats($mwenyekitiId)
    {
        return Cache::remember("mwenyekiti_{$mwenyekitiId}_ticket_stats", 600, function() use ($mwenyekitiId) {
            $baseQuery = Tickets::where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId);

            return [
                'total' => (clone $baseQuery)->count(),
                'open' => (clone $baseQuery)->byStatus(Tickets::STATUS_OPEN)->count(),
                'in_progress' => (clone $baseQuery)->byStatus(Tickets::STATUS_IN_PROGRESS)->count(),
                'resolved' => (clone $baseQuery)->byStatus(Tickets::STATUS_RESOLVED)->count(),
                'closed' => (clone $baseQuery)->byStatus(Tickets::STATUS_CLOSED)->count(),
                'urgent' => (clone $baseQuery)->byPriority(Tickets::PRIORITY_URGENT)
                    ->whereIn('status', [Tickets::STATUS_OPEN, Tickets::STATUS_IN_PROGRESS])
                    ->count(),
            ];
        });
    }

    /**
     * Close ticket (mark as feedback given)
     */
    public function close($id)
    {
        try {
            $mwenyekitiId = $this->getMwenyekitiId();
            
            if (!$mwenyekitiId) {
                return redirect()->route('mwenyekiti.login')
                    ->with('error', 'Tafadhali ingia kwanza');
            }

            $ticket = Tickets::where('id', $id)
                ->where('user_type', Tickets::USER_TYPE_MWENYEKITI)
                ->where('user_id', $mwenyekitiId)
                ->where('status', Tickets::STATUS_RESOLVED)
                ->firstOrFail();

            $ticket->close();

            // Clear cache
            Cache::forget("mwenyekiti_{$mwenyekitiId}_ticket_stats");

            return redirect()->route('mwenyekiti.support.index')
                ->with('success', 'Ombi limefungwa kikamilifu. Asante kwa kutoa maoni!');

        } catch (\Exception $e) {
            Log::error('Error closing ticket: ' . $e->getMessage(), [
                'ticket_id' => $id,
                'mwenyekiti_id' => $mwenyekitiId ?? null
            ]);

            return redirect()->back()
                ->with('error', 'Kuna tatizo katika kufunga ombi.');
        }
    }
}