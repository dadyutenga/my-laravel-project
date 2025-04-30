<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Watu extends Model
{
    protected $table = 'watu';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'date_of_birth',
        'gender',
        'marital_status',
        'occupation',
        'education_level',
        'income_range',
        'health_status',
        'nida_number',
        'house_no',
        'mtaa',
        'region',
        'district',
        'ward',
        'balozi_id',
        'household_count',
        'created_by',
        'is_active',
        'last_synced_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_of_birth' => 'date',
        'last_synced_at' => 'datetime',
    ];

    public function balozi()
    {
        return $this->belongsTo(Balozi::class, 'balozi_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(Balozi::class, 'created_by');
    }

    public function auth()
    {
        return $this->hasOne(WatuAuth::class, 'watu_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'created_by');
    }
}