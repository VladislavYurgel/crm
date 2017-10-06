<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Requests\CompanyRolesRequest;
use App\Repositories\CompanyRolesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyRolesController extends Controller
{
    /**
     * @var CompanyRolesRepository
     */
    private $companyRolesRepository;

    /**
     * CompanyRolesController constructor.
     * @param CompanyRolesRepository $companyRolesRepository
     */
    public function __construct(CompanyRolesRepository $companyRolesRepository)
    {
        $this->companyRolesRepository = $companyRolesRepository;
    }

    public function create(CompanyRolesRequest $request)
    {
        try {
            $companyRole = $this->companyRolesRepository->create($request);
        } catch (\Exception $exception) {

        }
    }
}
