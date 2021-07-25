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
        $domain = ['http://127.0.0.1:8000', 'http://localhost:8080', 'https://6yuwei.com', 'https://chimoochi-api.herokuapp.com'];
        $methods = 'PUT, GET, POST, DELETE, OPTIONS, PATCH';

        if ($origin && collect($domain)->contains($origin)) {
            return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin)
                    ->header('Access-Control-Allow-Methods', $methods)
                    ->header('Access-Control-Allow-Credentials', true)
                    ->header('Access-Control-Allow-Headers', '*');
        } else {
            return response()->json(['error' => 'CORS error'], 404)->header('Access-Control-Allow-Origin', $domain[2]);
        }

        // return $next($request)
        //             ->header('Access-Control-Allow', '*')
        //             ->header('Access-Control-Allow-Methods', '*');
    }
}
