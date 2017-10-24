<?php

namespace App\Repositories;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompanyDepartmentsRepository
{
    /**
     * @param Companies $company
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function departments(Companies $company)
    {
        return $company->departments()->get();
    }

    /**
     * @param Companies $company
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Companies $company, Request $request)
    {
        $newDepartment = $company->departments()->create($request->all());

        return $newDepartment;
    }

    /**
     * @param Companies $company
     * @param Request $request
     * @return bool
     */
    public function update(Companies $company, Request $request)
    {
        $updatedCompany = $company->update($request->all());

        return $updatedCompany;
    }

    public function delete(Companies $company)
    {

    }
}