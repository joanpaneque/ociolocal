<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Company;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'schedule'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}