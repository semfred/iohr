<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'path', 'type', 'upload_by', 'modified_by', 'mimetype'
    ];

    public function attachment()
    {
        return $this->belongsTo(LeaveAttachment::class);
    }

    public function uploader()
    {
        return $this->belongsTo('App\User', 'id', 'upload_by');
    }

    public function modifiedBy()
    {
        return $this->belongsToMany('App\User', 'id', 'modified_by');
    }
}
