<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahitajiMaalumu extends Model
{
    protected $table = 'mahitaji_maalumu';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender',
        'phone',
        'nida_number',
        'pdf_file_path',
        'created_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }
}