<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employee_id', 'amount', 'allowance_rice', 'allowance_transpo', 'allowance_laundry', 'allowance_other'
    ];

    protected $dates = [
        'effective_date'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employment', 'employee_id', 'id');
    }

    public function scopeLatestSalary($query)
    {
        return $query->orderBy('effective_date', 'desc');
    }
}
