<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employment extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employee_id', 'position_id', 'working_hrs', 'immediate_mngr', 'approving_mngr', 'employed', 'permanent', 'is_permanent'
    ];

    protected $dates = [
        'onboard_date', 'offboard_date', 'permanent'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function salary()
    {
        return $this->hasMany('App\Salary', 'employee_id', 'id')->orderBy('id', 'DESC');
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function immediateManager()
    {
        return $this->belongsTo('App\Employee', 'immediate_mngr', 'id');
    }

    public function approvingManager()
    {
        return $this->belongsTo('App\Employee', 'approving_mngr', 'id');
    }

    public function isStillEmployed()
    {
        return $this->employed ? true : false;
    }

    public function isPermanent()
    {
        return $this->permanent ? $this->permanent->lte(Carbon::now()) : false;
    }

}
