<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaendeleoYaSiku extends Model
{
    protected $table = 'maendeleo_ya_siku';

    protected $fillable = [
        'tarehe',
        'maelezo',
        'maoni',
        'created_by',
    ];

    protected $casts = [
        'tarehe' => 'date',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }
}