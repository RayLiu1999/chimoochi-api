<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => '帳號或密碼格式錯誤'], 422);
        }

        if (!$authToken = auth()->attempt($validator->validated())) {
            return response()->json(['success' => false, 'message' => '無效的驗證'], 401);
        };

        $refreshToken = $this->randomRefreshToken();

        User::where('email', $request->email)
            ->update(['refresh_token' => $refreshToken]);

        return $this->respondWithToken($authToken, $refreshToken);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => '帳號或密碼格式錯誤'], 422);
        }

        $user = User::where('email', $request->email)->first();
        if ($user !== null) {
            return response()->json(['success' => false, 'message' => '信箱已被使用'], 400);
        }

        User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'success' => true, 'message' => '註冊成功'
        ]);
    }


    public function logout(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');
        $user = User::where('refresh_token' , $refreshToken)->first();

        if ($user) {
            if (auth()->user()) {
                auth()->logout();
            }
            $user->update(['refresh_token' => $this->randomRefreshToken()]);
            return response()->json(['success' => true, 'message' => '登出成功'])->withCookie('refresh_token');
        }
        return response()->json(['success' => false, 'message' => '無此refresh_token'], 401);
    }


    public function refresh_token(Request $request)
    {
        $refreshToken = $request->cookie('refresh_token');
        $user = User::where('refresh_token' , $refreshToken)->first();
    
        if ($user) {
            $newRefreshToken = $this->randomRefreshToken();
            $user->update(['refresh_token' => $newRefreshToken]);
            if (auth()->user()) {
                $newAuthToken = auth()->refresh(true, true);
            } else {
                $newAuthToken = auth()->tokenById($user->id);
            }

            return $this->respondWithToken($newAuthToken, $newRefreshToken);
        }
        return response()->json(['success' => false, 'message' => '無效的驗證'], 401);
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

    private function respondWithToken($authToken, $newRefreshToken)
    {
        return response()->json([
            'success' => true,
            'authToken' => $authToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ])
        ->cookie('refresh_token', $newRefreshToken, 60 * 24);
    }

}