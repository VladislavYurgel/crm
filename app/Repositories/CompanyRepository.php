<?php

namespace App\Repositories;

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
        $company = Companies::create($data);

        if ($request->has('parent_company_id'))
            $company = $this->setParentCompany($company, $request->get('parent_company_id'));

        return $company;
    }

    /**
     * Update the company
     * @param Companies $company
     * @param CompanyRequest $request
     * @return bool
     */
    public function update(Companies $company, CompanyRequest $request)
    {
        $data = $request->except('parent_company_id');

        if ($request->has('parent_company_id'))
            $company = $this->setParentCompany($company, $request->get('parent_company_id'));

        return $company->update($data);
    }

    /**
     * Get company by id
     * @param $companyId
     * @return Companies
     */
    public function getById($companyId)
    {
        return Companies::find($companyId);
    }

    /**
     * @param Companies $company
     * @param $parentCompanyId
     * @return Companies|bool
     */
    private function setParentCompany(Companies $company, $parentCompanyId)
    {
        $parentCompany = $this->getById($parentCompanyId);
        if ($parentCompany) {
            $company->parent_company_id = $parentCompany->id;
            return $company;
        }
        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Companies::all();
    }
}