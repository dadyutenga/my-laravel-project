<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Sessions extends Model
{
    protected $fillable = [
        'session_id',
        'user_type',
        'user_id',
        'username',
        'email',
        'ip_address',
        'user_agent',
        'login_at',
        'logout_at',
        'is_active',
    ];

    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Relationships - Fixed: Remove the where clause from relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function mwenyekiti()
    {
        return $this->belongsTo(Mwenyekiti::class, 'user_id');
    }

    public function balozi()
    {
        return $this->belongsTo(Balozi::class, 'user_id');
    }

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query)
    {
        return $query->where('is_active', false);
    }

    public function scopeByUserType(Builder $query, string $userType)
    {
        return $query->where('user_type', $userType);
    }

    public function scopeToday(Builder $query)
    {
        return $query->whereDate('login_at', today());
    }

    public function scopeThisWeek(Builder $query)
    {
        return $query->whereBetween('login_at', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth(Builder $query)
    {
        return $query->whereMonth('login_at', now()->month)
                    ->whereYear('login_at', now()->year);
    }

    // Helper methods - Fixed: Check user_type before loading relationship
    public function getUser()
    {
        switch ($this->user_type) {
            case 'admin':
                return $this->admin;
            case 'mwenyekiti':
                return $this->mwenyekiti;
            case 'balozi':
                return $this->balozi;
            default:
                return null;
        }
    }

    public function getDurationAttribute()
    {
        if (!$this->logout_at) {
            return null; // Still active session
        }
        
        return $this->login_at->diffInMinutes($this->logout_at);
    }

    public function isOnline()
    {
        return $this->is_active && !$this->logout_at;
    }

    // Static methods for quick stats
    public static function getActiveSessionsCount()
    {
        return static::active()->whereNull('logout_at')->count();
    }

    public static function getTodaySessionsCount()
    {
        return static::today()->count();
    }

    public static function getSessionsTrend()
    {
        $currentMonth = static::thisMonth()->count();
        $lastMonth = static::whereMonth('login_at', now()->subMonth()->month)
                           ->whereYear('login_at', now()->subMonth()->year)
                           ->count();
        
        if ($lastMonth == 0) return ['percentage' => 0, 'direction' => 'up'];
        
        $percentage = round((($currentMonth - $lastMonth) / $lastMonth) * 100);
        
        return [
            'percentage' => abs($percentage),
            'direction' => $percentage >= 0 ? 'up' : 'down'
        ];
    }

    // Additional helper methods for getting users with proper type checking
    public function getAdminUser()
    {
        return $this->user_type === 'admin' ? $this->admin : null;
    }

    public function getMwenyekitiUser()
    {
        return $this->user_type === 'mwenyekiti' ? $this->mwenyekiti : null;
    }

    public function getBaloziUser()
    {
        return $this->user_type === 'balozi' ? $this->balozi : null;
    }
}