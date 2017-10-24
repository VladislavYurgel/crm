<?php

namespace App\Repositories;

use App\Http\Requests\Contracts\BaseApiRequest;
use App\Models\Companies;
use App\Models\CompanyPositions;
use Illuminate\Http\Request;

class CompanyPositionsRepository
{
    /**
     * @param Companies $company
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Companies $company, Request $request)
    {
        $position = $company->positions()->create($request->all());

        return $position;
    }

    /**
     * @param Companies $company
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getList(Companies $company)
    {
        return $company->positions()->get();
    }

    /**
     * @param CompanyPositions $companyPosition
     * @param BaseApiRequest $request
     * @return CompanyPositions
     */
    public function update(CompanyPositions $companyPosition, BaseApiRequest $request)
    {
        $companyPosition->update($request->all());

        return $companyPosition;
    }
}