<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

// class User extends Authenticatable implements MustVerifyEmail
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'employee_id', 'verified', 'superuser', 'type', 'password_changed'
    ];

    protected $dates = [
        'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $rules = [
        'name'      => 'required',
        'email'     => 'required|unique:users,email'
    ];

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new VerifyEmail); // my notification
    // }

    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }

    public function employee_info()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
    }

    public function uploaded_files()
    {
        return $this->hasMany('App\File', 'upload_by', 'id');
    }

    public function modified_files()
    {
        return $this->hasMany('App\File', 'modified_by', 'id');
    }

    public function announcement()
    {
        return $this->hasMany(CompanyAnnouncement::class);
    }

    public function approvedLeave()
    {
        return $this->hasMany('App\Leave', 'approved_by', 'id');
    }

    public function isAdmin()
    {
        return $this->type == 'admin' ? true : false;
    }
}
