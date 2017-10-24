<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Requests\Contracts\BaseApiRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Models\Companies;
use App\Models\CompanyPositions;
use App\Repositories\CompanyPositionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyPositionsController extends Controller
{
    /**
     * @var CompanyPositionsRepository
     */
    protected $companyPositionsRepository;

    /**
     * CompanyPositionsController constructor.
     * @param CompanyPositionsRepository $companyPositionsRepository
     */
    public function __construct(CompanyPositionsRepository $companyPositionsRepository)
    {
        $this->companyPositionsRepository = $companyPositionsRepository;
    }

    /**
     * @param Companies $company
     * @return $this|CompanyResource
     */
    public function getList(Companies $company)
    {
        try {
            $positions = $this->companyPositionsRepository->getList($company);

            return new CompanyResource($positions);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->addMessage($exception->getMessage())
                ->setStatus(ResponseStatuses::ERROR);
        }
    }

    /**
     * @param Companies $company
     * @param Request $request
     * @return $this|CompanyResource
     */
    public function store(Companies $company, Request $request)
    {
        try {
            $position = $this->companyPositionsRepository->store($company, $request);

            return new CompanyResource($position);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->addMessage($exception->getMessage())
                ->setStatus(ResponseStatuses::ERROR);
        }
    }

    /**
     * @param CompanyPositions $companyPosition
     * @param BaseApiRequest $request
     * @return $this|CompanyResource
     */
    public function update(CompanyPositions $companyPosition, BaseApiRequest $request)
    {
        try {
            $companyPosition = $this->companyPositionsRepository->update($companyPosition, $request);

            return new CompanyResource($companyPosition);
        } catch (\Exception $exception) {
            return (new CompanyResource())
                ->addMessage($exception->getMessage())
                ->setStatus(ResponseStatuses::ERROR);
        }
    }
}

