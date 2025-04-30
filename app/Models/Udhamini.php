<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Udhamini extends Model
{
    protected $table = 'udhamini';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'jinsia',
        'mtaa',
        'simu',
        'email',
        'nida',
        'sababu',
        'muelekeo',
        'tarehe',
        'picha',
        'created_by',
    ];

    protected $casts = [
        'tarehe' => 'date',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }
}