<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class MatangazoYaKawaida extends Model
{
    protected $table = 'matangazo_ya_kawaida';

    protected $fillable = [
        'created_by',
        'title',
        'title_sw',
        'content',
        'content_sw',
        'announcement_date',
        'effective_date',
        'expiry_date',
        'category',
        'priority',
        'target_audience',
        'mtaa',
        'status',
        'is_featured',
        'send_notification',
        'attachments',
        'views_count',
    ];

    protected $casts = [
        'announcement_date' => 'date',
        'effective_date' => 'date',
        'expiry_date' => 'date',
        'is_featured' => 'boolean',
        'send_notification' => 'boolean',
        'attachments' => 'array',
        'views_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with Mwenyekiti (creator)
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Mwenyekiti::class, 'created_by');
    }

    /**
     * Scope: Get active announcements
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope: Get featured announcements
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: Get announcements by category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /**
     * Scope: Get announcements by priority
     */
    public function scopeByPriority(Builder $query, string $priority): Builder
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope: Get current announcements (not expired)
     */
    public function scopeCurrent(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->whereNull('expiry_date')
              ->orWhere('expiry_date', '>=', now()->toDateString());
        });
    }

    /**
     * Scope: Get announcements for specific mtaa
     */
    public function scopeForMtaa(Builder $query, string $mtaa): Builder
    {
        return $query->where('mtaa', $mtaa);
    }

    /**
     * Scope: Get announcements by target audience
     */
    public function scopeForAudience(Builder $query, string $audience): Builder
    {
        return $query->where(function ($q) use ($audience) {
            $q->where('target_audience', $audience)
              ->orWhere('target_audience', 'all');
        });
    }

    /**
     * Scope: Get urgent announcements
     */
    public function scopeUrgent(Builder $query): Builder
    {
        return $query->where('priority', 'urgent');
    }

    /**
     * Check if announcement is expired
     */
    public function isExpired(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        
        return $this->expiry_date < now()->toDateString();
    }

    /**
     * Check if announcement is effective
     */
    public function isEffective(): bool
    {
        if (!$this->effective_date) {
            return true;
        }
        
        return $this->effective_date <= now()->toDateString();
    }

    /**
     * Check if announcement is currently active and valid
     */
    public function isCurrentlyActive(): bool
    {
        return $this->status === 'active' 
               && $this->isEffective() 
               && !$this->isExpired();
    }

    /**
     * Get the priority badge color
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'urgent' => '#ef4444',
            'high' => '#f59e0b',
            'normal' => '#10b981',
            'low' => '#6b7280',
            default => '#6b7280'
        };
    }

    /**
     * Get the category icon
     */
    public function getCategoryIconAttribute(): string
    {
        return match($this->category) {
            'emergency' => 'fas fa-exclamation-triangle',
            'event' => 'fas fa-calendar-alt',
            'notice' => 'fas fa-info-circle',
            'health' => 'fas fa-heartbeat',
            'security' => 'fas fa-shield-alt',
            'infrastructure' => 'fas fa-tools',
            'education' => 'fas fa-graduation-cap',
            'environment' => 'fas fa-leaf',
            default => 'fas fa-bullhorn'
        };
    }

    /**
     * Increment views count
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Get short content (for previews)
     */
    public function getShortContentAttribute(): string
    {
        return \Str::limit($this->content, 150);
    }

    /**
     * Get formatted announcement date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->announcement_date->format('d/m/Y');
    }

    /**
     * Auto-update status based on dates
     */
    public function updateStatusBasedOnDates(): void
    {
        if ($this->isExpired()) {
            $this->update(['status' => 'expired']);
        } elseif ($this->isEffective() && $this->status === 'draft') {
            $this->update(['status' => 'active']);
        }
    }

    /**
     * Boot method to handle model events
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-set announcement_date if not provided
        static::creating(function ($model) {
            if (!$model->announcement_date) {
                $model->announcement_date = now()->toDateString();
            }
        });

        // Auto-update status when saving
        static::saving(function ($model) {
            $model->updateStatusBasedOnDates();
        });
    }
}