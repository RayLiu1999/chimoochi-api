<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use Exception;

class JWTAuth
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
        try {
            $refreshToken = $request->cookie('refresh_token');
            $user = User::where('refresh_token', $refreshToken)->first();
            if ($user === null) {
                throw new Exception('無效驗證');
            }

            auth()->payload();
            return $next($request);
        }
        catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], 401);
        }
    }
}
