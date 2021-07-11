<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CartItemResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\User;

class CartController extends Controller
{
    private $validator;

    public function index(Request $request, User $user)  // 每次的請求，前端都要把jwt換掉`
    {
        $currentUser = $user->getUserFromRT($request);

        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            if (($DBcarts = $this->getDBCartItemsArray($currentUser)) !== false) {
                $cartItemsAry = $DBcarts[0];
                $amount = $DBcarts[1];
                return response()->json(['success' => true,
                                        'data' => [
                                            'carts' => $cartItemsAry,
                                            'amount' => $amount,
                                        ]]);
            } else {
                return $this->errorResponse('購物車為空', 400);
            }
        } else {
            // if (($carts = $this->getCartProducts($request)) !== false) {
            //     $cartItemsAry = $carts[0];
            //     $total = $carts[1];
            //     return response()->json(['success' => true,
            //                             'data' => [
            //                                 'carts' => $cartItemsAry,
            //                                 'total' => $total,
            //                                 ]]);
            // } else {
            //     return $this->errorResponse('購物車為空', 400);
            // }
        }
    }

    public function addToCart(Request $request, User $user, $id)
    {   
        $currentUser = $user->getUserFromRT($request);
        $quantity = $this->requestCheck($request);
        if ($this->validator->fails()) {
            return $this->errorResponse('格式錯誤', 400);
        }
        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            $this->addToDBCart($currentUser, $id, $quantity);
            return response()->json(['success' => true, 'message' => '加入資料庫購物車成功'])
                            ->withCookie('cart');
        } else {
            $cookieCart = $this->addToCookieCart($request, $id, $quantity);
            return $this->saveCookieCart($cookieCart, '加入購物車成功');
        }
    }

    public function checkout(Request $request, User $user)
    {
        $currentUser = $user->getUserFromRT($request);
        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            $result = $this->createOrderByCart($request, $currentUser);
            if ($result !== true) {
                if ($result === '格式錯誤'){
                    return $this->errorResponse('格式錯誤', 400);
                }
                if ($result === '訂單為空') {
                    return $this->errorResponse('訂單為空', 400);
                }
            }

            return response()->json(['success' => true, 'message' => '訂單建立成功']);
        }
        return $this->errorResponse('無效驗證', 401);
    }

    public function deleteCartItem(Request $request, User $user, $id)
    {
        $currentUser = $user->getUserFromRT($request);

        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            if ($this->deleteDBCart($request, $currentUser, $id)) {
                return response()->json(['success' => true, 'message' => '刪除資料庫購物車成功']);
            } else {
                return $this->errorResponse('刪除失敗', 400);
            }
        } else {
            if (($cookieCart = $this->deleteCookieCart($request, $id)) !== false ) {
                return $this->saveCookieCart($cookieCart, '刪除購物車成功');
            } else {
                return $this->errorResponse('刪除失敗', 400);
            }
        }
    }

    public function updateCartItem(Request $request, User $user, $id)
    {
        $currentUser = $user->getUserFromRT($request);
        $quantity = $this->requestCheck($request);

        if ($this->validator->fails()) {
            return $this->errorResponse('格式錯誤', 400);
        } 
        
        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            if ($this->updateToDBCart($currentUser, $quantity, $id)) {
                return response()->json(['success' => true, 'message' => '更新資料庫購物車成功']);
            } else {
                return $this->errorResponse('更新失敗', 400);
            }
        } else {
            if (($cookieCart = $this->updateToCookieCart($request, $quantity, $id)) !== false) {
                return $this->saveCookieCart($cookieCart, '更新購物車成功');
            } else {
                return $this->errorResponse('更新失敗', 400);
            }
        }
    }



    private function requestCheck(Request $request)
    {
        $quantity = $request->input('quantity');
        $this->validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|max:50',
        ]);
        return $quantity;
    }

    private function authTokenVerify()
    {
        if (auth()->user() !== null) {
            return true;
        }
        return false;
    }

    private function getDBCartItemsArray($currentUser)
    {
        $cartItemsAry = [];
        $productIdsAry = [];
        $amount = 0;

        $cartItems = $currentUser->getCartOrCreate()->cartItems;
        foreach ($cartItems as $cartItem) {
            array_push($productIdsAry, $cartItem->product_id);
        }
        $cartItemsAry = CartItemResource::collection($cartItems->whereIn('product_id', $productIdsAry));
        
        if (!$cartItemsAry) {
            return false;
        }
        foreach ($cartItemsAry as $cartItemAry) {
            $amount += (($cartItemAry->quantity) * ($cartItemAry->product->price));
        }

        return array($cartItemsAry, $amount);
    }


    // private function getCartProducts(Request $request, $cartItemsAry = [], $productIdsAry = [], $total = 0)
    // {
    //     $cookieCartsAry = [];
    //     $i = 0;
    //     $cookieCart = $this->getCartFromCookie($request);
        
    //     foreach ($cookieCart as $productIds => $quantity) {
    //         $productId = explode('_', $productIds)[2];
    //         array_push($productIdsAry, $productId);
    //         $cookieCartsAry[$productId] = $quantity;
    //     }

    //     $cartProducts = ProductResource::collection(Product::find($productIdsAry));

    //     if (!isset($cartProducts[0])) {
    //         return false;
    //     }

    //     foreach ($cartProducts as $cartProduct) {
    //         $cartItemsAry[$i]['product_id'] = $cartProduct->id;

    //         foreach ($cookieCartsAry as $productId => $quantity) {
    //             if ($productId === $cartProduct->id) {
    //                 $cartItemsAry[$i]['quantity'] = intval($quantity);
    //                 $total += $quantity * $cartProduct->price;
    //             }
    //         }
    //         $cartItemsAry[$i]['product'] = $cartProduct;
    //         $i += 1;
    //     }
    //     return array($cartItemsAry, $total);
    // }

    private function addToDBCart($currentUser, $id, $quantity)
    {
        $productId = $id;
        $cart = $currentUser->getCartOrCreate();
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
    }

    private function addToCookieCart(Request $request, $id, $quantity)
    {
        $cookieCart = $this->getCartFromCookie($request);
        $productId = "product_id_" . $id;
        if (isset($cookieCart[$productId])) {
            $cookieCart[$productId] += $quantity;
        } else {
            $cookieCart[$productId] = $quantity;
        }
        return $cookieCart;
    }

    private function deleteDBCart(Request $request, $currentUser, $id)
    {
        $productId = $id;
            $cartItem = $currentUser->getCartOrCreate()->cartItems()->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartItem->delete();
                return true;
            }
        return false;
    }

    private function deleteCookieCart(Request $request, $id)
    {
        $cookieCart = $this->getCartFromCookie($request);
        $productId = 'product_id_' . $id;

        if (isset($cookieCart[$productId])) {
            unset($cookieCart[$productId]);
            return $cookieCart;
        }
        return false;
    }

    private function updateToDBCart($currentUser, $quantity, $id)
    {
        $productId = $id;
        $cartItem = $currentUser->cart->cartItems()->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->update(['quantity' => $quantity]);
            return true;
        }
        return false;
    }

    private function updateToCookieCart(Request $request, $quantity, $id)
    {
        $cookieCart = $this->getCartFromCookie($request);
        $productId = "product_id_" . $id;
        if (isset($cookieCart[$productId])) {
            $cookieCart[$productId] = $quantity;
            return $cookieCart;
        }
        return false;
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

    private function errorResponse($message, $status)
    {
        return response()->json(['success' => false, 'message' => $message], $status);
    }

    private function getEndPrice($currentUser)
    {
        $amount = $this->getDBCartItemsArray($currentUser)[1];

        return $amount;
    }

    private function createOrderByCart(Request $request, $currentUser)
    {
        $cart = $currentUser->getCartOrCreate();
        $amount = $this->getEndPrice($currentUser);
        
        if ($amount === 0) {
            return '訂單為空';
        }

        $validator = Validator::make($request->all(), [
            'user.name' => ['required', 'string'],
            'user.email' => ['required', 'email'],
            'user.tel' => ['required', 'string', 'min:7'],
            'user.address' => ['required', 'string'],
            'message' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return '格式錯誤';
        }
        
        DB::transaction(function () use ($request, $currentUser, $cart, $amount) {  
            $order = Order::create([
                'ship_name' => $request->input('user.name'),
                'ship_email' => $request->input('user.email'),
                'ship_phone' => $request->input('user.tel'),
                'ship_address' => $request->input('user.address'),
                'ship_message' => $request->input('message'),
                'amount' => $amount,
                'user_id' => $currentUser->id,
            ]);

            $order->orderItems()->saveMany($cart->cartItems->map(function($cartItem) {
                return new OrderItem([
                    'name' => $cartItem->product->name,
                    'price' => $cartItem->product->price,
                    'quantity' => $cartItem->quantity,
                    'product_id' => $cartItem->product_id,
                ]);
            }));
            
            $cart->cartItems()->delete();
        });
        return true;
    }

}