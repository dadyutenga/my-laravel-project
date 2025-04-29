<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
    protected $fillable = [
        'admin_id',
        'phone_number',
        'address',
        'picture',
        'date_of_birth',
        'gender',
        'country',
        'region',
        'postal_code',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'gender' => 'string',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}