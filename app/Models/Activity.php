<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;
use App\Models\Booking;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'description'
    ];

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
