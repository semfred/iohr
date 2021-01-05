<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'type', 'country', 'observance', 'active'
    ];

    public function companyHolidays()
    {
        return $this->belongsTo(CompanyHoliday::class);
    }
}
