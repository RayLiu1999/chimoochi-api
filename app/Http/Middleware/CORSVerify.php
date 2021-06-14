<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CORSVerify
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
        $origin = $request->header('Origin');
        $domain = ['http://localhost:8080'];
        $methods = 'PUT, GET, POST, DELETE, OPTIONS';
        if ($origin && collect($domain)->contains($origin)) {
            return $next($request)
                    ->header('Access-Control-Allow', $origin)
                    ->header('Access-Control-Allow-Methods', $methods);
        } else {
            return response()->json(['error' => 'CORS error'], 404)->header('Access-Control-Allow', $domain[0]);
        }
    }
}
