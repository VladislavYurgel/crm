<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CompanyUsers
 *
 * @mixin \Eloquent
 * @property-read \App\Models\Companies $company
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function company()
    {
        return $this->hasOne(Companies::class, 'id', 'company_id');
    }
}
