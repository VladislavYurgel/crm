<?php

namespace App\Http\Controllers\Api\UserCompany;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Contracts\BaseApiResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCompanyController extends ApiController
{
    /**
     * Get user companies
     * @return BaseApiResource
     */
    public function getUserCompanies()
    {
        $userCompanies = $this->user()->companies()->with('company')->get()->pluck('company');

        return (new BaseApiResource($userCompanies));
    }
}
