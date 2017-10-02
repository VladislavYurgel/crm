<?php

namespace App\Http\Resources;

use App\Http\Resources\Contracts\BaseApiResource;

class CompanyResource extends BaseApiResource
{
    /**
     * Transform request to the array
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}