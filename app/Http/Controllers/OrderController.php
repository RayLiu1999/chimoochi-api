<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use App\Http\Resources\CartItemResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => OrderResource::collection(Order::all()),
        ]);
    }

    public function update(Request $request, $id)
    {
        if (($order = $this->checkRequest($request)) === false) {
            return $this->messageResponse(false, '格式錯誤', 400);
        }

        Order::find(1)
        ->update([
            'name' => $reqorder['name'],
            'code' => $reqorder['code'],
            'discount_present' => $reqorder['discount_present'],
            'is_enabled' => $reqorder['is_enabled'],
            'expired_at' => date("Y-m-d H:i:s", $reqorder['expired_at']),
        ]);

        return $this->messageResponse(true, '訂單更新成功');

    }



    private function checkRequest(Request $request)
    {
        $order = $request->input('data');
        $validator = Validator::make($order, [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'discount_present' => ['required', 'integer'],
            'is_enabled' => ['required', 'boolean'],
            'expired_at' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return false;
        }
        return $order;
    }

    private function messageResponse($boolean, $message, $status = 200)
    {
        return response()->json(['success' => $boolean, 'message' => $message], $status);
    }


    public function payment()
    {
        $hashKey = env('MPG_HashKey', '');
        $hashIV = env('MPG_hashIV', '');
        $tradeInfoAry = [
            'MerchantID' => env('MPG_MerchantID', ''),
            'Version' => env('MPG_Version', ''),
            'RespondType' => env('MPG_RespondType', ''),
            'TimeStamp' => time(),
            'LangType' => env('MPG_LangType', ''),
            'MerchantOrderNo' => '',
            'Amt' => '',
            'ItemDesc' => '一堆椅子',
            'TradeLimit' => env('MPG_TradeLimit', ''),
            'ExpireDate' => date('Ymd', strtotime(date('') . '+ 3 days')),
            'Email' => env('MPG_Email', ''),
            'LoginType' => env('MPG_LoginType', ''),
            'OrderComment' => '收到請檢查有無受損',
            'CREDIT' => env('MPG_CREDIT', ''),
            'InstFlag' => env('MPG_InstFlag', ''),
            'WEBATM' => env('MPG_WEBATM', ''),
            'VACC' => env('MPG_VACC', ''),
            'CVS' => env('MPG_CVS', ''),
            'BARCODE' => env('MPG_BARCODE', ''),
            //'CVSCOM' => '3',
            // 'ReturnURL' => env('APP_URL') . env('MPG_ReturnURL', ''),
            // 'NotifyURL' => env('APP_URL') . env('MPG_NotifyURL', ''),
            // 'CustomerURL' => env('APP_URL') . env('MPG_CustomerURL', ''),
            // 'ClientBackURL' => env('APP_URL') . env('MPG_ClientBackURL', ''),
        ];

        $tradeInfo = $this->create_mpg_aes_encrypt($tradeInfoAry, $hashKey, $hashIV);
        $tradeSha = strtoupper(hash("sha256", "HashKey={$hashKey}&{$tradeInfo}&HashIV={$hashIV}"));

        return response()->json([
            'MerchantID' => $tradeInfoAry['MerchantID'],
            'TradeInfo' => $tradeInfo,
            'TradeSha' => $tradeSha,
            'Version' => $tradeInfoAry['Version'],
        ]);
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

    private function errorResponse($message, $status)
    {
        return response()->json(['success' => false, 'message' => $message], $status);
    }

}
