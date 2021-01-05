<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'mngr'
    ];

    public function employees()
    {
        return $this->hasMany('App\Employment', 'position_id', 'id');
    }

    public function scopeManagers($query)
    {
        return $query->where('mngr', 1);
    }
}
