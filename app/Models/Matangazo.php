<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matangazo extends Model
{
    protected $table = 'matangazo';

    protected $fillable = [
        'mtaa_meeting_id',
        'created_by',
        'title',
        'title_sw',
        'content',
        'announcement_date',
        'mtaa',
        'status',
    ];

    protected $casts = [
        'announcement_date' => 'date',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function mtaaMeeting(): BelongsTo
    {
        return $this->belongsTo(MtaaMeeting::class, 'mtaa_meeting_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }
}