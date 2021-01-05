<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyHoliday extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'company_id', 'holiday_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function holiday()
    {
        return $this->hasOne(Holiday::class);
    }
}
