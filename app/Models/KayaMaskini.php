<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KayaMaskini extends Model
{
    // Specify the table name (optional if it matches the model name in snake_case)
    protected $table = 'kaya_maskini';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'street',
        'phone',
        'description',
        'household_count',
        'household_members',
        'created_by',
    ];

    // Define casts for specific fields (optional, based on data types)
    protected $casts = [
        'household_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the Balozi model
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }
}

?>