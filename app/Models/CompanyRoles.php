<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRoles extends Model
{
    protected $fillable = [
        'title',
        'priority',
        'company_id'
    ];
}
