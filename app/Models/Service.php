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
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the balozi who created the service request.
     * We're using created_by to reference Balozi instead of Watu.
     */
    public function createdByBalozi()
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }

    /**
     * Get the mwenyekiti assigned to the service.
     */
    public function assignedTo()
    {
        return $this->belongsTo(Mwenyekiti::class, 'assigned_to');
    }

    /**
     * Scope to restrict services to those visible by a specific balozi.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $baloziId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisibleToBalozi($query, $baloziId)
    {
        return $query->where('created_by', $baloziId);
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