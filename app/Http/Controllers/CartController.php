<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CartItemResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\User;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.jwt'])->except(['addToCart']);
    }

    public function index()
    {
        $currentUser = auth()->user();
        
        if (!$this->authTokenVerify()){
            return $this->errorResponse('auth token失效', 401);
        }
        
        $DBcarts = $this->getDBCartItemsArray($currentUser);
        $cartItemsAry = $DBcarts[0];
        $amount = $DBcarts[1];
        return response()->json(['success' => true,
                                'data' => [
                                    'carts' => $cartItemsAry,
                                    'amount' => $amount,
                                ]]);
    }

    public function addToCart(Request $request, User $user, $id)
    {
        $currentUser = $user->getUserFromRT($request);
        $quantity = $request->input('cart.quantity');

        $validator = Validator::make($request->input('cart'), [
            'quantity' => 'required|integer|max:50',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('格式錯誤', 400);
        }

        if ($currentUser) {
            if (!$this->authTokenVerify()){
                return $this->errorResponse('auth token失效', 401);
            }
            $this->addToDBCart($currentUser, $id, $quantity);

            return response()->json(['success' => true, 'message' => '加入資料庫購物車成功']);
        } else {
            $cookieCart = $this->addToCookieCart($request, $id, $quantity);
            return $this->saveCookieCart($cookieCart, '加入購物車成功');
        }
    }

    public function checkout(Request $request)
    {
        $currentUser = auth()->user();
        
        if (!$this->authTokenVerify()){
            return $this->errorResponse('auth token失效', 401);
        }
        $order = $this->createOrderByCart($request, $currentUser);
        if ($order === false){
            return $this->errorResponse('格式錯誤', 400);
        }
        if (empty($order)) {
            return $this->errorResponse('購物車為空', 400);
        }
        

        $hashKey = env('MPG_HashKey', '');
        $hashIV = env('MPG_HashIV', '');
        $expireDaysToPlus = env('MPG_ExpireDate', '');
        $tradeInfoAry = [
            'MerchantID' => env('MPG_MerchantID', ''),
            'Version' => env('MPG_Version', ''), 
            'RespondType' => env('MPG_RespondType', ''),
            'TimeStamp' => time(),
            'LangType' => env('MPG_LangType', ''),
            'MerchantOrderNo' => $order->order_number,
            'Amt' => $order->amount,
            'ItemDesc' => '一堆椅子',
            'TradeLimit' => env('MPG_TradeLimit', ''),
            'ExpireDate' => date('Ymd', strtotime(date('') . "+ $expireDaysToPlus days")),
            'Email' => $order->user->email,
            'LoginType' => env('MPG_LoginType', ''),
            'OrderComment' => '收到請檢查有無受損',
            'CREDIT' => env('MPG_CREDIT', ''),
            'InstFlag' => env('MPG_InstFlag', ''),
            'WEBATM' => env('MPG_WEBATM', ''),
            'VACC' => env('MPG_VACC', ''),
            'CVS' => env('MPG_CVS', ''),
            'BARCODE' => env('MPG_BARCODE', ''),
            //'CVSCOM' => '3',
            'ReturnURL' => env('MPG_ReturnURL', ''),
            // 'NotifyURL' => env('APP_URL') . env('MPG_NotifyURL', ''),
            // 'CustomerURL' => env('APP_URL') . env('MPG_CustomerURL', ''),
            'ClientBackURL' => env('MPG_ClientBackURL', ''),
        ];

        $tradeInfo = $this->create_mpg_aes_encrypt($tradeInfoAry, $hashKey, $hashIV);
        $tradeSha = strtoupper(hash("sha256", "HashKey={$hashKey}&{$tradeInfo}&HashIV={$hashIV}"));
        $actionUrl = 'https://ccore.newebpay.com/MPG/mpg_gateway';


        return response()->json([
            'success' => true,
            'message' => '訂單建立成功',
            'data' => [
                'actionUrl' => $actionUrl,
                'merchantID' => $tradeInfoAry['MerchantID'],
                'tradeInfo' => $tradeInfo,
                'tradeSha' => $tradeSha,
                'version' => $tradeInfoAry['Version'],
            ],
        ]);
    }

    public function applyCoupon(Request $request)
    {
        $currentUser = auth()->user();
        $code = $request->input('coupon.code');
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->errorResponse('格式錯誤', 400);
        }

        $coupon = Coupon::where('code', $code)->first();
        $cartItems = $currentUser->getCartOrCreate()->cartItems;
        foreach ($cartItems as $cartItem) {
            $cartItem->coupon_id = $coupon->id;
            $cartItem->save();
        }

        return response()->json(['success' => true, 'message' => '已套用優惠券']);
    }

    public function deleteCartItem(Request $request, $id)
    {
        $currentUser = auth()->user();

        if (!$this->authTokenVerify()){
            return $this->errorResponse('auth token失效', 401);
        }
        if ($this->deleteDBCart($currentUser, $id)) {
            return response()->json(['success' => true, 'message' => '刪除資料庫購物車成功']);
        } else {
            return $this->errorResponse('刪除失敗', 400);
        }
    }

    public function updateCartItem(Request $request, $id)
    {
        $currentUser = auth()->user();
        $quantity = $request->input('cart.quantity');

        $validator = Validator::make($request->input('cart'), [
            'quantity' => 'required|integer|max:50',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('格式錯誤', 400);
        } 
        
        if (!$this->authTokenVerify()) {
            return $this->errorResponse('auth token失效', 401);
        }
        if ($this->updateToDBCart($currentUser, $quantity, $id)) {
            return response()->json(['success' => true, 'message' => '更新資料庫購物車成功']);
        } else {
            return $this->errorResponse('更新失敗', 400);
        }
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
        
        $cartItemsAry = json_decode(json_encode($cartItemsAry));

        foreach ($cartItemsAry as $cartItemAry) {
            $amount += (($cartItemAry->quantity) * ($cartItemAry->discount_price));
        }
        
        return array($cartItemsAry, $amount);
    }

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

    private function deleteDBCart($currentUser, $id)
    {
        $productId = $id;
        $cartItem = $currentUser->getCartOrCreate()->cartItems()->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->delete();
            return true;
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

    private function getCartFromCookie(Request $request)
    {
        $jsonCart = $request->cookie('cart');
        return (!is_null($jsonCart)) ? json_decode($jsonCart, true) : [];
    }

    private function saveCookieCart($cookieCart, $message)
    {
        $cartToJson = empty($cookieCart) ? "{}" : json_encode($cookieCart, true);
        return response()->json(['success' => true, 'message' => $message])
                        ->cookie('cart', $cartToJson, 60 * 24 * 7, null, null, true, true);
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
        if ($cart->cartItems()->count() == 0) {
            return null;
        }

        $amount = $this->getEndPrice($currentUser);
        $order = null;

        $validator = Validator::make($request->all(), [
            'user.name' => ['required', 'string'],
            'user.email' => ['required', 'email', 'string'],
            'user.tel' => ['required', 'string', 'min:7'],
            'user.address' => ['required', 'string'],
            'message' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return false;
        }

        DB::transaction(function () use ($request, $currentUser, $cart, $amount, &$order) {  
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
                    'coupon_id' => $cartItem->coupon_id ?? null,
                ]);
            }));
            
            $cart->cartItems()->delete();
        });
        return $order;
    }

    private function create_mpg_aes_encrypt ($parameter = "" , $key = "", $iv = "") {
        $return_str = '';
        if (!empty($parameter)) {
            //將參數經過 URL ENCODED QUERY STRING
            $return_str = http_build_query($parameter);
        }
        return trim(bin2hex(openssl_encrypt($this->addpadding($return_str), 'aes-256-cbc', $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv)));
    }

    private function addpadding($string, $blocksize = 32) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }

}