<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MtaaMeeting extends Model
{
    protected $table = 'mtaa_meetings';

    protected $fillable = [
        'title',
        'title_sw',
        'agenda',
        'meeting_date',
        'mtaa',
        'organizer_id',
        'outcome',
    ];

    protected $casts = [
        'meeting_date' => 'date',
    ];

    public function organizer()
    {
        return $this->belongsTo(Mwenyekiti::class, 'organizer_id');
    }
}