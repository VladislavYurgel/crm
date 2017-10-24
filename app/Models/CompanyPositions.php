<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CompanyPositions
 *
 * @mixin \Eloquent
 */
class CompanyPositions extends Model
{
    protected $fillable = [
        'title',
        'company_id',
        'department_id',
        'default_salary',
        'description'
    ];
}
