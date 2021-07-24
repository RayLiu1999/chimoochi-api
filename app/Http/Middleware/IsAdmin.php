<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        if ((auth()->user()->is_admin) === 1) {
            return $next($request);
        }
        return response()->json(['success' => false, 'message' => '沒有權限'], 401);
    }
}