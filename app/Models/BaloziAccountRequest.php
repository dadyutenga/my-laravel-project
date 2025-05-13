<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaloziAccountRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'balozi_id',
        'mwenyekiti_id',
        'status',
        'requested_at',
        'processed_at',
        'admin_comments',
    ];

    protected $casts = [
        'status' => 'string',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function balozi()
    {
        return $this->belongsTo(Balozi::class);
    }

    public function mwenyekiti()
    {
        return $this->belongsTo(Mwenyekiti::class);
    }
}