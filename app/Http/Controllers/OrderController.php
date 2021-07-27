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
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        return response()->json([
            'success' => true,
            'data' => OrderResource::collection(Order::paginate($limit)),
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!$order = $this->checkRequest($request)) {
            return $this->messageResponse(false, '格式錯誤', 400);
        }

        Order::find($id)->update([
            'name' => $order['name'],
            'email' => $order['email'],
            'tel' => $order['tel'],
            'address' => $order['address'],
            'ship_message' => $request->message,
        ]);

        return $this->messageResponse(true, '訂單更新成功');
    }



    private function checkRequest(Request $request)
    {
        $order = $request->input('user');
        $validator = Validator::make($request->all(), [
            'user.name' => ['required', 'email', 'string'],
            'user.email' => ['required', 'string'],
            'user.tel' => ['required', 'string'],
            'user.address' => ['required', 'string', 'max: 50'],
            'message' => ['nullable', 'string'],
        ]);
        if ($validator->fails()) {
            return false;
        }
        return  $order;
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
            'MerchantOrderNo' => $order->order_number ?? 'gij1fdigjo1234',
            'Amt' => $order->amount ?? '123',
            'ItemDesc' => '一堆椅子',
            'TradeLimit' => env('MPG_TradeLimit', ''),
            'ExpireDate' => date('Ymd', strtotime(date('') . '+ 3 days')),
            'Email' => $order->user->email ?? '',
            'EmailModify' => env('MPG_EmailModify', ''),
            'LoginType' => env('MPG_LoginType', ''),
            'OrderComment' => '收到請檢查有無受損',
            'CREDIT' => env('MPG_CREDIT', ''),
            'InstFlag' => env('MPG_InstFlag', ''),
            'WEBATM' => env('MPG_WEBATM', ''),
            'VACC' => env('MPG_VACC', ''),
            'CVS' => env('MPG_CVS', ''),
            'BARCODE' => env('MPG_BARCODE', ''),
            // 'CVSCOM' => '3',
            // 'ReturnURL' => env('APP_URL') . env('MPG_ReturnURL', ''),
            // 'NotifyURL' => env('APP_URL') . env('MPG_NotifyURL', ''),
            // 'CustomerURL' => env('APP_URL') . env('MPG_CustomerURL', ''),
            'ClientBackURL' => env('APP_URL') . env('MPG_ClientBackURL', ''),
        ];

        $tradeInfo = $this->create_mpg_aes_encrypt($tradeInfoAry, $hashKey, $hashIV);
        $tradeSha = strtoupper(hash("sha256", "HashKey={$hashKey}&{$tradeInfo}&HashIV={$hashIV}"));

        // if ($status)

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
        return trim(bin2hex(
            openssl_encrypt(
                $this->addpadding($return_str),
                'aes-256-cbc',
                $key,
                OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING,
                $iv
            )
        ));
    }

    private function addpadding($string, $blocksize = 32) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }

    private function create_aes_decrypt($parameter = "", $key = "", $iv = "") {
        return strippadding(
            openssl_decrypt(
                hex2bin($parameter),
                'AES-256-CBC',$key,
                OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING,
                $iv
            )
        );
    }

    private function strippadding($string) {
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);

        if (preg_match("/$slastc{" . $slast . "}/", $string)) {
            $string = substr($string, 0, strlen($string) - $slast);
            return $string;
        } else {
            return false;   
        }
    }

}
