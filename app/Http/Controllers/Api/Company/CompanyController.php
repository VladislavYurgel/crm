<?php

namespace App\Http\Controllers\Api\Company;

use App\Exceptions\Company\CompanyNotFoundException;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Repositories\CompanyRepository;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyController constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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
        } catch (CompanyNotFoundException $exception) {
            return (new CompanyResource())
                ->setStatus(ResponseStatuses::ERROR)
                ->addMessage($exception->getMessage());
        }

        return new CompanyResource($company);
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
