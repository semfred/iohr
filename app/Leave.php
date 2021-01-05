<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Leave extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employee_id', 'type', 'note', 'request_by', 'approved', 'approved_by', 'from_date', 'to_date', 'archived', 'other_specify'
    ];

    protected $dates = [
        'from_date', 'to_date'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approveUser()
    {
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }

    public function hours()
    {
        return $this->hasMany(LeaveHours::class);
    }

    public function attachment()
    {
        return $this->hasOne(LeaveAttachment::class);
    }

    public function getCurrentStatusAttribute()
    {
        $ret = '';
        switch($this->status) {
            case 'APP'  :
                $ret = 'Approved';
                break;
            case 'CAN'  :
                $ret = 'Canceled';
                break;
            case 'DEC':
                $ret = 'Declined';
                break;
            default:
                $ret = 'Pending';
        }

        return $ret;

    }
}
