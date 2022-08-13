<?php

namespace App\Http\Middleware;

use App\Traits\ApiGeneralTrait;
use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssignGuard extends BaseMiddleware
{
    use ApiGeneralTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null) {
            //use guard type (like: admin or user) which i pass to it
            auth()->shouldUse($guard);

            $token = $request->header('auth_token');
            $request->headers->set('auth_token', $token);
            $request->headers->set('Authorization', 'Bearer '.$token);
            try {
                if($token) {
                    $user = JWTAuth::parseToken()->authenticate(); //check if authinticated and bass token
                }
                else {
                    return $this->returnErrorMsg(001, 'something is wrong');
                }
            } catch(Exception $e) {
                return $this->returnErrorMsg(401, 'Unauthinticated');
            }
        }

        return $next($request);
    }
}
