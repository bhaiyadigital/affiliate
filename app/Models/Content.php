<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Content extends Model
{
    protected $table = 'contents';
    protected $fillable = [
        'module',
        'title',
        'name',
        'slug',
        'prev_slug',
        'parent_id',
        'destination_id',
        'user_id',
        'description',
        'description_1',
        'description_2',
        'description_3',
        'short',
        'body_titles',
        'section_statuses',
        'features',
        'extra',
        'url',
        'location',
        'img_path',
        'img_paths',
        'video_path',
        'video_paths',
        'start_date',
        'end_date',
        'published_at',
        'scheduled_at',
        'trashed_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'sort_order',
        'views',
        'status'

    ];

    public function destination()
    {
        return $this->belongsTo(Content::class, 'destination_id');
    }
    protected $casts = [
        'body_titles' => 'array',
        'section_statuses' => 'array',
        'features' => 'array',
        'extra' => 'array',
        'img_paths' => 'array',
        'video_paths' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'trashed_at' => 'datetime',
    ];

    const STATUS_INACTIVE  = 0;
    const STATUS_ACTIVE    = 1;
    const STATUS_SCHEDULED = 2;
    const STATUS_TRASH     = 3;



    // Parent record (e.g. album for a gallery photo)
    public function parent()
    {
        return $this->belongsTo(Content::class, 'parent_id');
    }

    // Child records (e.g. gallery photos under an album)
    public function children()
    {
        return $this->hasMany(Content::class, 'parent_id')->orderBy('sort_order');
    }

    // ------------------------------------------------------------------
    // Query scopes
    // ------------------------------------------------------------------

    // Filter by module name
    public function scopeModule(Builder $query, string $module): Builder
    {
        return $query->where('module', $module);
    }

    // Only active records
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Active + scheduled records that are now past their published_at
    public function scopePublished(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('status', self::STATUS_ACTIVE)
                ->orWhere(function ($q2) {
                    $q2->where('status', self::STATUS_SCHEDULED)
                        ->where('published_at', '<=', now());
                });
        });
    }

    // Exclude trashed records
    public function scopeNotTrashed(Builder $query): Builder
    {
        return $query->where('status', '!=', self::STATUS_TRASH);
    }

    // Only trashed records
    public function scopeTrashed(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_TRASH);
    }

    // Order by sort_order ascending
    public function scopeSorted(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }


    // Returns human-readable status label
    public function getStatusLabelAttribute(): string
    {
        return match ((int) $this->status) {
            self::STATUS_ACTIVE    => 'Active',
            self::STATUS_INACTIVE  => 'Inactive',
            self::STATUS_SCHEDULED => 'Scheduled',
            self::STATUS_TRASH     => 'Trash',
            default                => 'Unknown',
        };
    }

    // Slug helper — generate unique slug from a given string
    public static function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 1;

        while (
            static::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
    private function getPublicUrl(?string $path): ?string
    {
        if (!$path) return null;
        if (filter_var($path, FILTER_VALIDATE_URL)) return $path;

        $cleanPath = str_replace(['public/', 'storage/'], '', ltrim($path, '/'));

        return asset('storage/' . $cleanPath);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->img_path) return null;

        $path = ltrim(str_replace('public/', '', $this->img_path), '/');
        return Storage::disk('public')->url($path);
    }
    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->img_paths || !is_array($this->img_paths)) return [];

        return array_map(function ($path) {
            return asset('storage/' . $path);
        }, $this->img_paths);
    }

    /**
     * 3. Video URL
     */
    public function getVideoUrlAttribute(): ?string
    {
        return $this->getPublicUrl($this->video_path);
    }

    /**
     * 4. Multiple Video URLs
     */
    public function getMultiVideoUrlsAttribute(): array
    {
        $paths = is_array($this->video_paths) ? $this->video_paths : [];
        return array_map(fn($p) => $this->getPublicUrl($p), $paths);
    }

// ------------------------------------------------------------------
    // Coupon Logic Methods (Add these before the last '}')
    // ------------------------------------------------------------------

    /**
     * চেক করে কুপনটি বর্তমানে কার্যকর কি না
     */
    public function isCouponValid()
    {
        $now = now();

        // ১. স্ট্যাটাস চেক
        if ($this->status != self::STATUS_ACTIVE) {
            return ['status' => false, 'message' => 'Coupon is disabled.'];
        }

        // ২. শুরুর তারিখ চেক
        if ($this->start_date && $now->lt($this->start_date)) {
            return ['status' => false, 'message' => 'Coupon not active yet.'];
        }

        // ৩. শেষের তারিখ চেক
        if ($this->end_date && $now->gt($this->end_date)) {
            return ['status' => false, 'message' => 'Coupon has expired.'];
        }

        // ৪. মোট ব্যবহারের সীমা চেক (views কলামটি লিমিট হিসেবে ব্যবহৃত হচ্ছে)
        $extra = $this->extra ?? [];
        $usedCount = $extra['used_count'] ?? 0;

        if ($this->views > 0 && $usedCount >= $this->views) {
            return ['status' => false, 'message' => 'Total usage limit reached.'];
        }

        return ['status' => true, 'message' => 'Valid'];
    }

    /**
     * চেক করে নির্দিষ্ট ফোন নম্বর দিয়ে কুপন ব্যবহারের সীমা শেষ কি না
     */
    public function isUserLimitReached($phone)
    {
        // 'name' কলামে প্রতি ইউজারের লিমিট রাখা হয়েছে
        $perUserLimit = (int) ($this->name ?? 1);

        $usageCount = \App\Models\Lead::where('coupon_code', $this->slug)
            ->where('phone', $phone)
            ->count();

        return $usageCount >= $perUserLimit;
    }
    public function getUsedCountAttribute()
    {
        return $this->extra['used_count'] ?? 0;
    }
}
