<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.jwt', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $cartItemsAry = [];
        $user = auth()->user();

        if ($user) {
            $cartItems = $user->getCartOrCreate()->cartItems;
            foreach ($cartItems as $cartItem) {
                array_push($cartItemsAry, $cartItem);
            }
    
            return response()->json(['success' => true, 'message' => $cartItemsAry]);
        } else {
            $cookieCart = $this->getCartFromCookie($request);
            foreach ($cookieCart as $productIds => $quantity) {
                $productId = explode('_', $productIds)[2];
                array_push($cartItemsAry, [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    
                ]);
                
            }
            return response()->json(['success' => true, 'message' => $cartItemsAry]);
        }
        return response()->json(['success' => false, 'message' => '失敗'], 400);
    }


    public function addToCart(Request $request, $id)
    {   
        $user = auth()->user();
        $quantity = $request->input('quantity');

        if ($user) {
            $productId = $id;
            $jsonCart = $request->cookie('cart');
            $cookieCart = (!is_null($jsonCart)) ? json_decode($jsonCart) : [];
            $cart = $user->getCartOrCreate();
            $cartItem = $cart->cartItems()->where('product_id', $id)->first();
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
            return response()->json(['success' => true, 'message' => '加入資料庫購物車成功'])
                            ->withCookie('cart');
        } else {
            $cookieCart = $this->getCartFromCookie($request);
            $productId = "product_id_" . $id;
            if (isset($cookieCart[$productId])) {
                $cookieCart[$productId] += $quantity;
            } else {
                $cookieCart[$productId] = $quantity;
            }
            return $this->saveCookieCart($cookieCart, '加入購物車成功');
        }
    }

    public function deleteCartItem(Request $request, $id)
    {
        $user = auth()->user();

        if ($user) {
            $productId = $id;
            $cartItem = $user->getCartOrCreate()->cartItems()->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->delete();
                return response()->json(['success' => true, 'message' => '刪除資料庫購物車成功']);
            }
            return response()->json(['success' => false, 'message' => '刪除失敗'], 400);
        }
        $cookieCart = $this->getCartFromCookie($request);
        $productId = 'product_id_' . $id;
        if (isset($cookieCart[$productId])) {
            unset($cookieCart[$productId]);
            return $this->saveCookieCart($cookieCart, '刪除購物車成功');
        }
        return response()->json(['success' => false, 'message' => '刪除失敗'], 400);
    }

    public function updateCartItem(Request $request, $id)
    {
        $user = auth()->user();
        $quantity = $request->input('quantity');    
        
        if ($user) {
            $productId = $id;
            $cartItem = $user->cart->cartItems()->where('product_id', $productId)->first();
            dd($cartItem);
            if ($cartItem) {
                $cartItem->update(['quantity' => $quantity]);
                return response()->json(['success' => true, 'message' => '更新資料庫購物車成功']);
            }
            return response()->json(['success' => false, 'message' => '更新失敗'], 400);
        }
        $cookieCart = $this->getCartFromCookie($request);
        $productId = "product_id_" . $id;
        if (isset($cookieCart[$productId])) {
            $cookieCart[$productId] = $quantity;
            return $this->saveCookieCart($cookieCart, '更新購物車成功');
        }
        return response()->json(['success' => false, 'message' => '更新失敗'], 400);
    }

    public function show($id)
    {
        //
    }

    private function getCartFromCookie(Request $request)
    {
        $jsonCart = $request->cookie('cart');
        return (!is_null($jsonCart)) ? json_decode($jsonCart, true) : [];
    }

    private function saveCookieCart($cookieCart, $message)
    {
        $cartToJson = empty($cookieCart) ? "{}" : json_encode($cookieCart, true);
            return response()->json(['success' => true, 'message' => $message])
                            ->cookie('cart', $cartToJson, 60 * 24 * 7);
    }
}
