<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyAnnouncement extends Model
{
    use HasApiTokens, SoftDeletes;

    protected $fillable = [
        'title', 'content', 'priority', 'company_id', 'user_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
