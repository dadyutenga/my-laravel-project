<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahitajiMaalumu extends Model
{
    // Specify the table name
    protected $table = 'mahitaji_maalumu';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'phone',
        'nida_number',
        'disability_type', // Added new column
        'pdf_file_path',
        'created_by',
    ];

    // Define casts for specific fields
    protected $casts = [
        'age' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the Balozi model
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }
}