<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\BaseApiRequest;
use App\Repositories\UserRepository;

class CompanyRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'company_parent_id' => [
                'integer'
            ],
            'name' => [
                'string',
                'required',
                'min:1'
            ],
            'description' => [
                'string'
            ]
        ];
    }
}
