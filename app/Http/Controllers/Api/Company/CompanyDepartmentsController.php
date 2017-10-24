<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Models\Companies;
use App\Repositories\CompanyDepartmentsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyDepartmentsController extends ApiController
{
    /**
     * @var CompanyDepartmentsRepository
     */
    private $companyDepartmentRepository;

    /**
     * CompanyDepartmentsController constructor.
     * @param CompanyDepartmentsRepository $companyDepartmentsRepository
     */
    public function __construct(CompanyDepartmentsRepository $companyDepartmentsRepository)
    {
        $this->companyDepartmentRepository = $companyDepartmentsRepository;
    }

    /**
     * @param Companies $company
     * @return $this|CompanyResource
     */
    public function departments(Companies $company)
    {
        try {
            $departments = $this->companyDepartmentRepository->departments($company);

            return new CompanyResource($departments);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }
    }

    /**
     * @param Companies $company
     * @param Request $request
     * @return $this|CompanyResource
     */
    public function create(Companies $company, Request $request)
    {
        try {
            $newDepartment = $this->companyDepartmentRepository->create($company, $request);

            return new CompanyResource($newDepartment);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }
    }

    /**
     * @param Companies $company
     * @param Request $request
     * @return $this|CompanyResource
     */
    public function update(Companies $company, Request $request)
    {
        try {
            $updatedCompany = $this->companyDepartmentRepository->update($company, $request);

            return new CompanyResource($updatedCompany);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }
    }

    public function delete(Companies $company)
    {
        $this->companyDepartmentRepository->delete($company);
        //TODO: make deleting, check for users, which contain this department
    }
}
