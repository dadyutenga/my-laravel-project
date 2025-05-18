<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaendeleoYaMwenyekiti extends Model
{
    // Specify the table name
    protected $table = 'maendeleo_ya_mwenyekiti';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'tarehe',
        'maelezo',
        'maoni',
        'created_by',
    ];

    // Define casts for specific fields
    protected $casts = [
        'tarehe' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the Mwenyekiti model
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }
}