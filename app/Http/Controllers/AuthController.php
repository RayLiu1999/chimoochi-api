<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Cookie;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '帳號或密碼格式錯誤'], 422);
        }

        if (!$authToken = auth()->attempt($validator->validated())) {
            return response()->json(['message' => '無效的驗證'], 401);
        };

        $refreshToken = $this->randomRefreshToken();

        User::where('email', $request->email)
            ->update(['refresh_token' => $refreshToken]);


        return response()->json($this->respondWithToken($authToken))->withCookie('refresh_token', $refreshToken, 60 * 24 );
    }

    private function randomRefreshToken($length = 32, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        if (!is_int($length) || $length < 0) {
            return false;
        }

        $characters_length = strlen($characters) - 1;
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, $characters_length)];
        }
        return $string;
    }


    public function logout()
    {

    }

    public function refresh_token(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');
        
        try {
            $users = User::where('refresh_token', $refreshToken)->firstOrFail();
        }
        catch (Exception $e) {
            return response()->json(['message' => '無效的驗證'], 401);
        }

        // dd($users); 
        // $users->update(['refresh_token' => $this->randomRefreshToken()]);

    }

    protected function respondWithToken($authToken)
    {
        return [
            'authToken' => $authToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
    // public function setCookie()
    // {
    //     $minutes = 60;
    //     $response = new Response('Set Cookie');
    //     $response->withCookie(cookie('refresh_token', 34358935, $minutes));
    //     return $response;
    // }
}