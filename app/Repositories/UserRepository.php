<?php

namespace App\Repositories;

use App\Http\Requests\RegisterRequest;
use App\User;

class UserRepository
{
    const MIN_PASS_LENGTH = 6;

    /**
     * Create the user
     * @param RegisterRequest $request
     * @return mixed
     */
    public function create(RegisterRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->get('password'));

        return User::create($data);
    }
}