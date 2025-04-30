<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'status' => 'string',
    ];
}