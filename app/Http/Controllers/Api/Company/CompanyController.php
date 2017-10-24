<?php

namespace App\Http\Controllers\Api\Company;

use App\Exceptions\Company\CompanyNotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Models\Companies;
use App\Repositories\CompanyRepository;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyUserRepository;

class CompanyController extends ApiController
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var CompanyUserRepository
     */
    private $companyUserRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $companyRepository
     * @param CompanyUserRepository $companyUserRepository
     */
    public function __construct(CompanyRepository $companyRepository, CompanyUserRepository $companyUserRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companyUserRepository = $companyUserRepository;
    }

    /**
     * Create the company
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function create(CompanyRequest $request)
    {
        try {
            $company = $this->companyRepository->create($request);
            $this->companyUserRepository->assign($this->user(), $company);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }

        return new CompanyResource($company);
    }

    /**
     * @param Companies $company
     * @return $this|CompanyResource
     */
    public function getUsers(Companies $company)
    {
        try {
            $users = $this->companyUserRepository->getUsers($company);

            return new CompanyResource($users);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->addMessage($exception->getMessage())
                ->setStatus(ResponseStatuses::ERROR);
        }
    }

    /**
     * Update the company
     * @param CompanyRequest $request
     * @return CompanyResource
     */
    public function update(CompanyRequest $request)
    {
        try {
            $company = $this->companyRepository->getById(\Route::input('id'));
            $company = $this->companyRepository->update($company, $request);
        } catch (CompanyNotFoundException $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }

        return new CompanyResource($company);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->companyRepository->all();
    }
}
