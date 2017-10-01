<?php

namespace App\Http\Requests;

use App\Http\Requests\Contracts\BaseApiRequest;
use App\Repositories\UserRepository;

class RegisterRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'first_name' => [
                'required',
                'min:1'
            ],
            'last_name' => [
                'required',
                'min:1'
            ],
            'email' => [
                'required',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:' . UserRepository::MIN_PASS_LENGTH
            ]
        ];
    }
}
