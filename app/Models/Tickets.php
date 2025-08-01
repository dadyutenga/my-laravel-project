<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tickets extends Model
{
    use SoftDeletes;

    protected $table = 'tickets';

    protected $fillable = [
        'ticket_number',
        'title',
        'description',
        'priority',
        'status',
        'category',
        'user_type',
        'user_id',
        'assigned_to',
        'resolution',
        'resolved_at',
        'closed_at',
        'attachments',
        'tags'
    ];

    protected $casts = [
        'resolved_at' => 'datetime',
        'closed_at' => 'datetime',
        'attachments' => 'array',
        'tags' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Status constants
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_CLOSED = 'closed';

    // Priority constants
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    // User type constants
    const USER_TYPE_MWENYEKITI = 'mwenyekiti';
    const USER_TYPE_BALOZI = 'balozi';
    const USER_TYPE_ADMIN = 'admin';

    /**
     * Get the user who created the ticket
     */
    public function creator()
    {
        if ($this->user_type === self::USER_TYPE_MWENYEKITI) {
            return $this->belongsTo(Mwenyekiti::class, 'user_id');
        } elseif ($this->user_type === self::USER_TYPE_BALOZI) {
            return $this->belongsTo(BaloziAuth::class, 'user_id');
        } elseif ($this->user_type === self::USER_TYPE_ADMIN) {
            return $this->belongsTo(Admin::class, 'user_id');
        }
        
        return null;
    }

    /**
     * Get the admin assigned to handle this ticket
     */
    public function assignedAdmin()
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }

    /**
     * Generate unique ticket number
     */
    public static function generateTicketNumber()
    {
        do {
            $number = 'TCK-' . date('Y') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (self::where('ticket_number', $number)->exists());

        return $number;
    }

    /**
     * Scope for filtering by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for filtering by priority
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope for filtering by user type
     */
    public function scopeByUserType($query, $userType)
    {
        return $query->where('user_type', $userType);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case self::STATUS_OPEN:
                return 'blue';
            case self::STATUS_IN_PROGRESS:
                return 'yellow';
            case self::STATUS_RESOLVED:
                return 'green';
            case self::STATUS_CLOSED:
                return 'gray';
            default:
                return 'blue';
        }
    }

    /**
     * Get priority badge color
     */
    public function getPriorityColorAttribute()
    {
        switch ($this->priority) {
            case self::PRIORITY_LOW:
                return 'green';
            case self::PRIORITY_MEDIUM:
                return 'yellow';
            case self::PRIORITY_HIGH:
                return 'orange';
            case self::PRIORITY_URGENT:
                return 'red';
            default:
                return 'blue';
        }
    }

    /**
     * Check if ticket is open
     */
    public function isOpen()
    {
        return $this->status === self::STATUS_OPEN;
    }

    /**
     * Check if ticket is closed
     */
    public function isClosed()
    {
        return $this->status === self::STATUS_CLOSED;
    }

    /**
     * Mark ticket as resolved
     */
    public function markAsResolved($resolution = null)
    {
        $this->update([
            'status' => self::STATUS_RESOLVED,
            'resolution' => $resolution,
            'resolved_at' => now(),
        ]);
    }

    /**
     * Close the ticket
     */
    public function close()
    {
        $this->update([
            'status' => self::STATUS_CLOSED,
            'closed_at' => now(),
        ]);
    }
}