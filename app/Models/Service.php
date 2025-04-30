<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'title',
        'title_sw',
        'description',
        'status',
        'mtaa',
        'assigned_to',
        'created_by',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(Mwenyekiti::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(Watu::class, 'created_by');
    }
}