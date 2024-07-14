<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Activity;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'booking_datetime',
        'is_validated',
        'user_id',
        'activity_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
