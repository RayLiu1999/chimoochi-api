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
            // $refreshToken = $request->cookie('refresh_token');
            // $user = User::where('refresh_token', $refreshToken)->first();
            // if ($user === null) {
            //     throw new Exception('無效驗證');
            // }
            $user = auth()->payload();  // 錯誤訊息在 \vender\tymon\jwt-auth\src
            return $next($request);
        }
        catch (Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 401);
        }
    }
}
