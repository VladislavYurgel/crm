<?php

namespace App\Repositories;

use App\Models\Companies;
use App\User;

class CompanyUserRepository
{
    /**
     * @param User $user
     * @param Companies $company
     */
    public function assign(User $user, Companies $company)
    {
        $company->users()->attach($user->id);
    }

    /**
     * @param Companies $company
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsers(Companies $company)
    {
        return $company->users()->get();
    }
}