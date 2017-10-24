<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CompanyRoles
 *
 * @mixin \Eloquent
 */
class CompanyRoles extends Model
{
    protected $fillable = [
        'title',
        'priority',
        'company_id'
    ];
}
