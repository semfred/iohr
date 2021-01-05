<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'fname', 'mname', 'lname', 'gender', 'civil_status', 'birthday', 'email', 'contact_no', 'tin_no', 'pagibig_no', 'sss_no', 'philhealth_no', 'noDependents'
    ];

    protected $dates = [
        'birthday'
    ];

    public function getNameAttribute()
    {
        return $this->fname . ' ' . $this->mname . ' ' . $this->lname;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employment()
    {
        return $this->hasOne(Employment::class);
    }

    public function entitlement()
    {
        return $this->hasOne(Entitlement::class);
    }

    public function emergencyContact()
    {
        return $this->hasMany(EmeregencyContact::class);
    }

    public function leave_requests()
    {
        return $this->hasMany(Leave::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function getBirthday($value)
    {
        return $value->format('Y-m-d');
    }

    public function latestSalary()
    {
        return $this->salaries()->orderBy('effective_date', 'desc')->first();
    }
}
