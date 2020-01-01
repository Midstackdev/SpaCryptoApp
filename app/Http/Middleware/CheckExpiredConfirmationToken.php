<?php

namespace App\Http\Middleware;

use Closure;

class CheckExpiredConfirmationToken
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
        if ($request->confirmation_token->hasExpired()) {
            return response()->json([
                'data' => [
                    'error' => 'Confirmation token is expired.'
                ],
            ], 401);
        }

        return $next($request);
    }
}
