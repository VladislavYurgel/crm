<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\BaseApiRequest;
use App\Repositories\UserRepository;

class LoginRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'min:' . UserRepository::MIN_PASS_LENGTH
            ]
        ];
    }
}
