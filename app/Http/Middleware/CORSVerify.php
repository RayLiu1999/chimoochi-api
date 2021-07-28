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
        $domain = ['http://127.0.0.1:8000', 'http://localhost:8080', 'https://6yuwei.com', 'https://chimoochi-api.herokuapp.com', 'http://127.0.0.1:8080', 'http://127.0.0.1:5500'];
        $methods = 'PUT, GET, POST, DELETE, PATCH, OPTIONS';
        $headers = 'Content-Type, Authorization, X-Custom-Header';
        
        if ($request->getMethod() == "OPTIONS") {
            return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin)
                    ->header('Access-Control-Allow-Methods', $methods)
                    ->header('Access-Control-Allow-Credentials', 'true')
                    ->header('Access-Control-Allow-Headers', $headers);
        }

        if ($origin && collect($domain)->contains($origin)) {
            return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin)
                    ->header('Access-Control-Allow-Methods', $methods)
                    ->header('Access-Control-Allow-Credentials', 'true')
                    ->header('Access-Control-Allow-Headers', $headers);
        } else {
            return response()->json(['error' => 'CORS error'], 404);
        }
    }
}
