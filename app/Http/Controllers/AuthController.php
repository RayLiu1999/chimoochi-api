<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\CartItem;

class AuthController extends Controller
{
    public function login(Request $request, User $user)
    {
        $validator = $this->checkRequest($request);
        if ($validator === false) {
            return $this->messageResponse(false, '帳號或密碼格式錯誤', 400);
        }
        if (!$authToken = auth('api')->attempt($validator->validated())) {
            return $this->messageResponse(false, '無效的驗證', 401);
        };
        
        $refreshToken = $this->randomRefreshToken();

        $user->where('email', $request->input('user.email'))
            ->update(['refresh_token' => $refreshToken]);

        $currentUser = $user->first();
        if ($cookieCart = $request->cookie('cart')) {
            $this->cookieCartAddToCartItem($cookieCart, $currentUser);
        }

        return response()->json([
            'success' => true,
            'message' => '登入成功',
            'data' => [
                'authToken' => $authToken,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ])
        ->cookie('refresh_token', $refreshToken, 60 * 24, null, null, true, true)
        ->withoutCookie('cart');
    }


    public function register(Request $request)
    {
        $validator = $this->checkRequest($request);
        if ($validator === false) {
            return $this->messageResponse(false, '帳號或密碼格式錯誤', 400);
        }

        $user = User::where('email', $request->input('user.email'))->first();
        if ($user !== null) {
            return $this->messageResponse(false, '信箱已被使用', 400);
        }

        $refreshToken = $this->randomRefreshToken();
        User::create([
                'email' => $request->input('user.email'),
                'password' => bcrypt($request->input('user.password')),
                'refresh_token' => $refreshToken
            ]);

        return $this->messageResponse(true, '註冊成功');
    }


    public function logout(User $user)
    {
        if (auth()->user()) {
            auth()->logout();
        }
        $user->update(['refresh_token' => $this->randomRefreshToken()]);
        
        return response()->json(['success' => true, 'message' => '登出成功'])->withoutCookie('refresh_token');
    }


    public function refresh_token(Request $request, User $user)
    {
        $user = $user->getUserFromRT($request);

        if ($user) {
            $newRefreshToken = $this->randomRefreshToken();
            $user->update(['refresh_token' => $newRefreshToken]);
            if (auth()->user()) {
                $newAuthToken = auth()->refresh(true, true);
            } else {
                $newAuthToken = auth()->tokenById($user->id);
            }

            return response()->json([
                'success' => true,
                'message' => '刷新成功',
                'data' => [
                    'authToken' => $newAuthToken,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                ]
            ])
            ->cookie('refresh_token', $newRefreshToken, 60 * 24);
        }
        return $this->messageResponse(false, '無效的refresh token', 401);
    }


    private function checkRequest(Request $request)
    {
        $validator = Validator::make($request->input('user'), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6']
        ]);
        if ($validator->fails()) {
            return false;
        }
        return $validator;
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

    private function messageResponse($boolean, $message, $status = 200)
    {
        return response()->json(['success' => $boolean, 'message' => $message], $status);
    }

    private function cookieCartAddToCartItem($cookieCart, $currentUser)
    {
        $cart = $currentUser->getCartOrCreate();
        $cookieCartAry = json_decode($cookieCart, true);
        
        foreach ($cookieCartAry as $key => $value) {
            $productId = str_replace('product_id_', '', $key);
            $cookieCartAry[$productId] = $cookieCartAry[$key];
            unset($cookieCartAry[$key]);
        }

        foreach ($cookieCartAry as $productId => $quantity) {
            $cartItem = $cart->cartItems()->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                $cart->cartItems()->save(
                    new CartItem([
                        'product_id' => $productId,
                        'quantity' => $quantity
                    ])
                );
            }

        }
    }

}