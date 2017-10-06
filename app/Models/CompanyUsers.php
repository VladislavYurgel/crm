<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CompanyUsers
 *
 * @mixin \Eloquent
 */
class CompanyUsers extends Model
{
    protected $fillable = [
        'company_id',
        'user_id',
        'role_id',
        'hire_date',
        'fire_date'
    ];
}
