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

    private function errorResponse($message, $status)
    {
        return response()->json(['success' => false, 'message' => $message], $status);
    }

}
