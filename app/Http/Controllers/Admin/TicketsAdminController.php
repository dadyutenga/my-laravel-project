<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Admin;
use App\Models\BaloziAuth;
use App\Models\Mwenyekiti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TicketsAdminController extends Controller
{
    /**
     * Display a listing of all tickets with filters
     */
    public function index(Request $request)
    {
        $query = Tickets::with(['assignedAdmin'])->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%") // Changed from 'title' to 'subject'
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter by user type
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        // Filter by assigned admin
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $tickets = $query->paginate(15);
        $admins = Admin::orderBy('name')->get();

        // Statistics
        $stats = [
            'total' => Tickets::count(),
            'open' => Tickets::where('status', 'open')->count(),
            'in_progress' => Tickets::where('status', 'in_progress')->count(),
            'resolved' => Tickets::where('status', 'resolved')->count(),
            'closed' => Tickets::where('status', 'closed')->count(),
            'unassigned' => Tickets::whereNull('assigned_to')->count(),
            'high_priority' => Tickets::whereIn('priority', ['high', 'urgent'])->count(),
        ];

        return view('Admin.tickets.index', compact('tickets', 'admins', 'stats'));
    }

    /**
     * Display the specified ticket
     */
    public function show($id)
    {
        $ticket = Tickets::with(['assignedAdmin'])->findOrFail($id);
        
        // Get creator details based on user type
        $creator = $this->getTicketCreator($ticket);
        
        $admins = Admin::orderBy('name')->get();

        return view('Admin.tickets.view', compact('ticket', 'creator', 'admins'));
    }

    /**
     * Assign ticket to admin
     */
    public function assign(Request $request, $id)
    {
        $request->validate([
            'assigned_to' => 'required|exists:admins,id'
        ]);

        $ticket = Tickets::findOrFail($id);
        $ticket->update([
            'assigned_to' => $request->assigned_to,
            'status' => $ticket->status === 'open' ? 'in_progress' : $ticket->status
        ]);

        return redirect()->back()->with('success', 'Ticket has been assigned to admin.');
    }

    /**
     * Update ticket status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed',
            'admin_response' => 'nullable|string|max:2000' // Changed from 'resolution' to 'admin_response'
        ]);

        $ticket = Tickets::findOrFail($id);
        
        $updateData = ['status' => $request->status];
        
        if ($request->status === 'resolved' && $request->filled('admin_response')) {
            $updateData['admin_response'] = $request->admin_response;
            $updateData['resolved_at'] = now();
        } elseif ($request->status === 'closed') {
            $updateData['closed_at'] = now();
        }

        $ticket->update($updateData);

        return redirect()->back()->with('success', 'Ticket status has been updated.');
    }

    /**
     * Add admin response to ticket
     */
    public function respond(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'required|string|max:2000'
        ]);

        $ticket = Tickets::findOrFail($id);
        $ticket->update([
            'admin_response' => $request->admin_response,
            'status' => $ticket->status === 'open' ? 'in_progress' : $ticket->status,
            'assigned_to' => $ticket->assigned_to ?: Auth::guard('admin')->id()
        ]);

        return redirect()->back()->with('success', 'Your response has been added.');
    }

    /**
     * Bulk operations on tickets
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'tickets' => 'required|array',
            'tickets.*' => 'exists:tickets,id',
            'action' => 'required|in:assign,status_change,delete'
        ]);

        $tickets = Tickets::whereIn('id', $request->tickets);

        switch ($request->action) {
            case 'assign':
                $request->validate(['assigned_to' => 'required|exists:admins,id']);
                $tickets->update([
                    'assigned_to' => $request->assigned_to,
                    'status' => 'in_progress'
                ]);
                $message = 'Tickets have been assigned to admin.';
                break;

            case 'status_change':
                $request->validate(['new_status' => 'required|in:open,in_progress,resolved,closed']);
                $updateData = ['status' => $request->new_status];
                
                if ($request->new_status === 'resolved') {
                    $updateData['resolved_at'] = now();
                } elseif ($request->new_status === 'closed') {
                    $updateData['closed_at'] = now();
                }
                
                $tickets->update($updateData);
                $message = 'Ticket statuses have been updated.';
                break;

            case 'delete':
                $tickets->delete();
                $message = 'Tickets have been deleted.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Download ticket attachment
     */
    public function downloadAttachment($ticketId, $attachmentIndex)
    {
        $ticket = Tickets::findOrFail($ticketId);
        $attachments = json_decode($ticket->attachments, true);

        if (!isset($attachments[$attachmentIndex])) {
            abort(404, 'Attachment not found');
        }

        $attachment = $attachments[$attachmentIndex];
        $filePath = 'tickets/' . $attachment['filename'];

        if (!Storage::exists($filePath)) {
            abort(404, 'File not found');
        }

        return Storage::download($filePath, $attachment['original_name']);
    }

    /**
     * Export tickets to CSV
     */
    public function export(Request $request)
    {
        $query = Tickets::with(['assignedAdmin']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', $request->assigned_to);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $tickets = $query->get();

        $filename = 'tickets_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($tickets) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Ticket Number', 'Subject', 'Status', 'Priority', 'User Type', 
                'Created At', 'Assigned To', 'Resolved At', 'Admin Response'
            ]);

            foreach ($tickets as $ticket) {
                fputcsv($file, [
                    $ticket->ticket_number,
                    $ticket->subject, // Changed from 'title' to 'subject'
                    ucfirst(str_replace('_', ' ', $ticket->status)),
                    ucfirst($ticket->priority),
                    ucfirst($ticket->user_type),
                    $ticket->created_at->format('Y-m-d H:i:s'),
                    $ticket->assignedAdmin ? $ticket->assignedAdmin->name : 'Unassigned',
                    $ticket->resolved_at ? $ticket->resolved_at->format('Y-m-d H:i:s') : '',
                    $ticket->admin_response ? substr($ticket->admin_response, 0, 100) . '...' : ''
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get ticket creator based on user type
     */
    private function getTicketCreator($ticket)
    {
        switch ($ticket->user_type) {
            case 'balozi':
                return BaloziAuth::find($ticket->user_id);
            case 'mwenyekiti':
                return Mwenyekiti::find($ticket->user_id);
            case 'admin':
                return Admin::find($ticket->user_id);
            default:
                return null;
        }
    }
}