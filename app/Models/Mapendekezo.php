<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapendekezo extends Model
{
    protected $table = 'mapendekezo';

    protected $fillable = [
        'maelezo',
        'maeneo',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }
}