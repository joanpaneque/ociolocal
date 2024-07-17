<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Activity;
use App\Models\Schedule;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'company_email',
        'company_phone',
        'company_address',
        'company_nif',
        'legal_representative_name',
        'legal_representative_email',
        'legal_representative_phone',
        'iban',
        'image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($company) {
            Schedule::create([
                'company_id' => $company->id
            ]);
        });
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
