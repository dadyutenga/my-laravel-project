<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MtaaMeetingRequest extends Model
{
    protected $table = 'mtaa_meeting_requests';

    protected $fillable = [
        'balozi_id',
        'status',
        'request_details',
        'requested_at',
        'processed_at',
        'admin_comments',
    ];

    protected $casts = [
        'status' => 'string',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function balozi(): BelongsTo
    {
        return $this->belongsTo(Balozi::class, 'balozi_id');
    }
}