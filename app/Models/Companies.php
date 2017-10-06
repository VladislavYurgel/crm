<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Companies
 *
 * @mixin \Eloquent
 * @property-read \App\Models\Companies $parentCompany
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
}
