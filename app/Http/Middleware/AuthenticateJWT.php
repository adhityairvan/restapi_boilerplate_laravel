<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Sametsahindogan\JWTRedis\Http\Middleware\BaseMiddleware;
use App\Services\ErrorBuilder;
use App\Services\ErrorResult;

class AuthenticateJWT extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     *
     * @return JsonResponse
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->setIfClaimIsNotExist($request);
        } catch (TokenExpiredException | TokenInvalidException | JWTException | TokenBlacklistedException $e) {
            return $this->getErrorResponse($e);
        }

        if (config('jwtredis.check_banned_user')) {
            $this->setAuthedUser($request);

            if (!$request->authedUser->checkUserStatus()) {
                return $this->getErrorResponse('AccountBlockedException');
            }
        }

        return $next($request);
    }

    /**
     * We changed default http 200 status to 401 for any failed auth
     * @param $exception
     *
     * @return JsonResponse
     */
    protected function getErrorResponse($exception)
    {
        $error = config('jwtredis.errors.'.class_basename($exception)) ?? config('jwtredis.errors.default');

        return response()->json(
            new ErrorResult(
                (new ErrorBuilder())
                    ->message($error['message'])
            ), 401
        );
    }
}
