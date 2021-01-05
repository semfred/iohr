<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'est_date'
    ];

    protected $dates = [
        'est_date'
    ];

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }

    public function announcements()
    {
        return $this->hasMany(CompanyAnnouncement::class);
    }
}
