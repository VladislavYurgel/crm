<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest, JWTAuth;
use App\Http\Resources\Contracts\ResponseStatuses;
use App\Http\Resources\UserResource;
use Tymon\JWTAuth\Exceptions\JWTException;

trait LoginController
{
    public function login(LoginRequest $request)
    {
        try {
            if (!$token = JWTAuth::attempt($request->only('email', 'password'))) {
                return (new UserResource())
                    ->addMessage('Invalid email or password')
                    ->setStatus(ResponseStatuses::ERROR)
                    ->setErrorNumber(config('errors.auth.invalid_credentials'));
            }
        } catch (JWTException $exception) {
            return (new UserResource())
                ->addMessage('Failed to create token')
                ->setStatus(ResponseStatuses::ERROR)
                ->setErrorNumber(config('error.auth.create_token_failed'));
        }

        $user = \Auth::user();

        return (new UserResource())
            ->setData($user)
            ->setToken($token);
    }
}