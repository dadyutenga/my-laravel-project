<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaloziAuth extends Model
{
    protected $table = 'balozi_auths';

    protected $fillable = [
        'balozi_id',
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

    public function balozi()
    {
        return $this->belongsTo(Balozi::class, 'balozi_id');
    }
}