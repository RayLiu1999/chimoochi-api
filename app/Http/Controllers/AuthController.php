<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
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

        return response()->json($this->respondWithToken($authToken))
                        ->cookie('refresh_token', $refreshToken, 60 * 24);
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

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '帳號或密碼格式錯誤'], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user !== null) {
            return response()->json(['message' => '信箱已被使用'], 400);
        }

        User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => '註冊成功'
        ]);
    }

    public function logout(Request $request)
    {
        try {
            $refreshToken = $request->cookie('refresh_token');
            $user = User::where('refresh_token', $refreshToken);
            $user->update(['refresh_token' => $this->randomRefreshToken()]);
            return response()->json(['message' => '登出成功'])->withCookie('refresh_token');
        }
        catch (Exception $e) {
            return response()->json(['message' => '無效的驗證'], 401);
        }
    }

    public function refresh_token(Request $request)
    {
        try {
            $refreshToken = $request->cookie('refresh_token');
            $user = [];
            $newRefreshToken = $this->randomRefreshToken();
            
            $user = User::where('refresh_token', $refreshToken);
            $authToken = auth()->login($user->firstOrFail());
            $user->update(['refresh_token' => $newRefreshToken]);

            return response()->json($this->respondWithToken($authToken))
                            ->cookie('refresh_token', $newRefreshToken, 60 * 24);
        }
        catch (Exception $e) {
            return response()->json(['message' => '無效的驗證'], 401);
        }
    }

    protected function respondWithToken($authToken)
    {
        return [
            'authToken' => $authToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }

    public function user(Request $request)
    {
        return response()->json(auth()->user());
    }
}