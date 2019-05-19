<?php

namespace App\Http\Middleware;

use App\Exceptions\NotLoginException;
use Closure;

class Authenticate {
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     * @throws NotLoginException
     */
    public function handle ($request, Closure $next) {
        $response = $next($request);
        if (!$request->session()->get('user_id')) {
            throw new NotLoginException();
        }

        return $response;
    }
}
