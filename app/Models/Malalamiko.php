<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Balozi;

class Malalamiko extends Model
{
    protected $table = 'malalamiko';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'mtaa',
        'jinsia',
        'malalamiko',
        'status',
        'created_by',
    ];

    protected $casts = [
        'status' => 'string',
        'created_by' => 'integer',
    ];

    /**
     * Get the Balozi who created this Malalamiko record
     */
    public function balozi(): BelongsTo
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }
}