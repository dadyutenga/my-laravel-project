<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatuAuth extends Model
{
    protected $table = 'watu_auths';

    protected $fillable = [
        'watu_id',
        'username',
        'password',
        'remember_token',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function watu()
    {
        return $this->belongsTo(Watu::class, 'watu_id');
    }
}