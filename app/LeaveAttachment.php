<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LeaveAttachment extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'leave_id', 'file_id'
    ];

    public $timestamps = false;

    public function leave()
    {
        return $this->belongsTo('App\Leave', 'id', 'leave_id');
    }

    public function file()
    {
        return $this->hasOne('App\File', 'id', 'file_id');
    }
}
