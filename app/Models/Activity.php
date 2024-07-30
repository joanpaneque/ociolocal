<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;
use App\Models\Booking;
use App\Models\ActivityImage;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_name',
        'season',
        'date_start',
        'date_end',
        'date_event',
        'max_concurrent_people',
        'weekly_schedule',
        'ticket_types',
        'contribution',
        'company_id',
        'clicks',
        'views',
    ];

    // cols that shouldn't be sent to the frontend
    protected $hidden = [
        'contribution'
    ];

    protected $appends = [
        'discount'
    ];

    public function getDiscountAttribute()
    {
        return $this->attributes['contribution'] / 2;
    }

    public function images()
    {
        return $this->hasMany(ActivityImage::class)->with('image');
    }

    public function scopeInProgress($query)
    {
        $today = (new \DateTime())->format('Y-m-d');

        return $query->where(function($query) use ($today) {
            $query->where('season', true)
                ->where('date_start', '<=', $today)
                ->where('date_end', '>=', $today);
        })->orWhere(function($query) use ($today) {
            $query->where('season', false)
                ->where('date_event', '=', $today);
        });
    }

    public function scopeUpcoming($query)
    {
        $today = (new \DateTime())->format('Y-m-d');

        return $query->where(function($query) use ($today) {
            $query->where('season', true)
                ->where('date_start', '>', $today);
        })->orWhere(function($query) use ($today) {
            $query->where('season', false)
                ->where('date_event', '>', $today);
        });
    }

    public function scopePast($query)
    {
        $today = (new \DateTime())->format('Y-m-d');

        return $query->where(function($query) use ($today) {
            $query->where('season', true)
                ->where('date_end', '<', $today);
        })->orWhere(function($query) use ($today) {
            $query->where('season', false)
                ->where('date_event', '<', $today);
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function book($user)
    {
        return $this->bookings()->create([
            'user_id' => $user->id,
            'booking_datetime' => now(),
            'qr_code' => 'ocio-' . uniqid(),
            'is_validated' => false
        ]);
    }
}
