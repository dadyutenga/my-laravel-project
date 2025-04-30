<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MwenyekitiAuth extends Model
{
    protected $table = 'mwenyekiti_auths';

    protected $fillable = [
        'mwenyekiti_id',
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

    public function mwenyekiti()
    {
        return $this->belongsTo(Mwenyekiti::class, 'mwenyekiti_id');
    }
}