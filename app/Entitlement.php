<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Entitlement extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employee_id', 'vacation', 'sick', 'year'
    ];

    public $timestamps = false;

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
