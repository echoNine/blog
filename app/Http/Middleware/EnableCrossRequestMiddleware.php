<?php

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequestMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle ($request, Closure $next) {
        $response = $next($request);

        $response->header('Access-Control-Allow-Origin', $this->getOrigin($request));
        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function getOrigin ($request) {
        $url = parse_url($request->header('Referer'));
        if (!isset($url['scheme']) || !isset($url['host']) || !isset($url['port'])) {
            return '*';
        }
        return "{$url['scheme']}://{$url['host']}:{$url['port']}";
    }
}
