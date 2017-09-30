<?php

namespace App\Http\Middleware;

use App\Http\Resources\ResponseStatuses;
use App\Http\Resources\UserResource;
use Closure, Exception, JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::toUser($request->input('token'));
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return (new UserResource())
                    ->setStatus(ResponseStatuses::ERROR)
                    ->addMessage('Token is invalid')
                    ->setErrorNumber(config('error.auth.invalid_token'));
            } else if ($exception instanceof TokenExpiredException) {
                return (new UserResource())
                    ->setStatus(ResponseStatuses::ERROR)
                    ->addMessage('Token is expired')
                    ->setErrorNumber(config('error.auth.expired_token'));
            } else {
                return (new UserResource())
                    ->setStatus(ResponseStatuses::ERROR)
                    ->addMessage('Something is wrong');
            }
        }

        return $next($request);
    }
}
