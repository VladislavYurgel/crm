<?php

namespace App\Http\Middleware;

use App\Http\Resources\Contracts\BaseApiResource;
use App\Http\Resources\Contracts\ResponseStatuses;
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
        $response = new BaseApiResource();

        try {
            JWTAuth::parseToken()->authenticate();

            return $next($request);
        } catch (TokenInvalidException $exception) {
            $response->setStatus(ResponseStatuses::ERROR)
                ->addMessage('Token is invalid');
        } catch (TokenExpiredException $exception) {
            $response->setStatus(ResponseStatuses::ERROR)
                ->addMessage('Token is expired');
        } catch (Exception $exception) {
            $response->setStatus(ResponseStatuses::ERROR)
                ->addMessage("Token not found");
        };

        return response([
            'message' => $response->getMessages(),
            'status' => ResponseStatuses::ERROR
        ], 200);
    }
}
