<?php

namespace App\Http\Middleware;

use App\Exceptions\InvalidTokenException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header("token") !== "token") {
            abort(Response::HTTP_FORBIDDEN, "Token is invalid");
        }

        return $next($request);
    }
}
