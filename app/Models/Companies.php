<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Companies
 *
 * @mixin \Eloquent
 * @property-read \App\Models\Companies $parentCompany
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CompanyDepartments[] $departments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 */
class Companies extends Model
{
    protected $fillable = [
        'company_parent_id',
        'name',
        'description',
        'created_by'
    ];

    /**
     * Get parent company relationships
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentCompany()
    {
        return $this->hasOne(Companies::class, 'id', 'company_parent_id');
    }

    /**
     * Get users, which assigned to the company
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'company_users', 'company_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany(CompanyDepartments::class, 'company_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positions()
    {
        return $this->hasMany(CompanyPositions::class, 'company_id', 'id');
    }
}
