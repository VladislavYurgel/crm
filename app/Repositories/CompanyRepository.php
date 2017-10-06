<?php

namespace App\Repositories;

use App\Exceptions\Company\CompanyNotFoundException;
use App\Http\Requests\CompanyRequest;
use App\Models\Companies;

class CompanyRepository
{
    /**
     * Create the company
     * @param CompanyRequest $request
     * @return Companies
     */
    public function create(CompanyRequest $request)
    {
        $data = $request->except('parent_company_id');
        $data['created_by'] = \Auth::user()->id;
        $company = Companies::create($data);

        if ($request->has('parent_company_id'))
            $this->setParentCompany($company, $request->get('parent_company_id'));

        return $company;
    }

    /**
     * Update the company
     * @param Companies $company
     * @param CompanyRequest $request
     * @return Companies
     */
    public function update(Companies $company, CompanyRequest $request)
    {
        $data = $request->except('parent_company_id');
        $data['created_by'] = \Auth::user()->id;

        if ($request->has('parent_company_id'))
            $this->setParentCompany($company, $request->get('parent_company_id'));

        $company->update($data);

        return $company;
    }

    /**
     * Get company by id
     * @param $companyId
     * @return Companies
     * @throws CompanyNotFoundException
     */
    public function getById($companyId)
    {
        $company = Companies::find($companyId);

        if (!$company) {
            throw new CompanyNotFoundException(trans('company.errors.company_not_found'));
        }

        return $company;
    }

    /**
     * @param Companies $company
     * @param $parentCompanyId
     * @throws CompanyNotFoundException
     */
    private function setParentCompany(Companies &$company, $parentCompanyId)
    {
        $parentCompany = $this->getById($parentCompanyId);

        if (!$parentCompany) {
            throw new CompanyNotFoundException(trans('company.errors.parent_company_not_found'));
        }

        $company->parent_company_id = $parentCompany->id;
        $company->save();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Companies::all();
    }
}