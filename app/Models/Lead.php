<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    // স্ট্যাটাস কনস্ট্যান্ট
    const STATUS_PENDING   = 1;
    const STATUS_CONTACTED = 2;
    const STATUS_VISIT     = 3;
    const STATUS_BOOKED    = 4;
    const STATUS_COMPLETED = 5;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'interested_location',
        'budget',
        'type',
        'referrer_id',
        'coupon_code',
        'remarks',
        'status',
    ];

    public static function statusLabels()
    {
        return [
            self::STATUS_PENDING   => 'pending',
            self::STATUS_CONTACTED => 'contacted',
            self::STATUS_VISIT     => 'visit',
            self::STATUS_BOOKED    => 'booked',
            self::STATUS_COMPLETED => 'complete',
        ];
    }

    public function getStatusLabelAttribute()
    {
        return self::statusLabels()[$this->status] ?? 'unknown';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
