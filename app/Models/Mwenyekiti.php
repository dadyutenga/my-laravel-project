<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mwenyekiti extends Model
{
    protected $table = 'mwenyekiti';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'national_id',
        'ward',
        'mtaa',
        'region',
        'photo',
        'is_active',
        'last_synced_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'date_of_birth' => 'date',
        'last_synced_at' => 'datetime',
    ];

    public function auth()
    {
        return $this->hasOne(MwenyekitiAuth::class, 'mwenyekiti_id');
    }

    public function balozi()
    {
        return $this->hasMany(Balozi::class, 'mwenyekiti_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'assigned_to');
    }

    public function meetings()
    {
        return $this->hasMany(MtaaMeeting::class, 'organizer_id');
    }

    public function mapendekezo()
    {
        return $this->hasMany(Mapendekezo::class, 'created_by');
    }

    public function udhamini()
    {
        return $this->hasMany(Udhamini::class, 'created_by');
    }

    /**
     * Get all general announcements created by this Mwenyekiti
     */
    public function matangazoYaKawaida()
    {
        return $this->hasMany(MatangazoYaKawaida::class, 'created_by');
    }

    /**
     * Get active general announcements
     */
    public function activeMatangazoYaKawaida()
    {
        return $this->hasMany(MatangazoYaKawaida::class, 'created_by')
                    ->where('status', 'active')
                    ->where(function ($query) {
                        $query->whereNull('expiry_date')
                              ->orWhere('expiry_date', '>=', now()->toDateString());
                    });
    }
}