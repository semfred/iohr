<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeaveHours extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'leave_id', 'hours', 'approved_by', 'from_date', 'to_date'
    ];

    protected $dates = [
        'from_date', 'to_date'
    ];

    public function leave()
    {
        return $this->belongsTo(App\Leave::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'approved_by', 'id');
    }

}
