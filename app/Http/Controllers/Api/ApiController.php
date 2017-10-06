<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Contracts\BaseApiResource;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController
{
    private $user = null;

    public function response()
    {

    }

    /**
     * @return User
     */
    public function user()
    {
        if (is_null($this->user)) {
            $this->user = JWTAuth::parseToken()->toUser();
        }
        return $this->user;
    }
}