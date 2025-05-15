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
        'created_by_balozi',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the balozi who created the service request.
     */
    public function createdByBalozi()
    {
        return $this->belongsTo(Balozi::class, 'created_by_balozi');
    }

    /**
     * Get the mwenyekiti assigned to the service.
     */
    public function assignedTo()
    {
        return $this->belongsTo(Mwenyekiti::class, 'assigned_to');
    }

    /**
     * Scope to restrict services to those visible by a specific mwenyekiti.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $mwenyekitiId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleToMwenyekiti($query, $mwenyekitiId)
    {
        return $query->whereHas('createdByBalozi', function ($query) use ($mwenyekitiId) {
            $query->where('mwenyekiti_id', $mwenyekitiId);
        });
    }
}