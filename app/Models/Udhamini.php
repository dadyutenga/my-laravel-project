<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Udhamini extends Model
{
    protected $table = 'udhamini';

    protected $fillable = [
        'watu_id',
        'sababu',
        'muelekeo',
        'tarehe',
        'picha',
        'created_by',
    ];

    protected $casts = [
        'tarehe' => 'date',
    ];

    public function watu()
    {
        return $this->belongsTo(Watu::class, 'watu_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }

    // Helper methods to access Watu fields easily
    public function getFirstNameAttribute()
    {
        return $this->watu->first_name ?? null;
    }

    public function getMiddleNameAttribute()
    {
        return $this->watu->middle_name ?? null;
    }

    public function getLastNameAttribute()
    {
        return $this->watu->last_name ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->watu->email ?? null;
    }

    public function getJinsiaAttribute()
    {
        return $this->watu->gender ?? null;
    }

    public function getMtaaAttribute()
    {
        return $this->watu->mtaa ?? null;
    }

    public function getSimuAttribute()
    {
        return $this->watu->phone_number ?? null;
    }

    public function getNidaAttribute()
    {
        return $this->watu->nida_number ?? null;
    }
}