<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EmeregencyContact extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'employee_id', 'name', 'relationship', 'contact_no'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
