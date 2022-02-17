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
            'ship_name' => $order['name'],
            'ship_email' => $order['email'],
            'ship_phone' => $order['tel'],
            'ship_address' => $order['address'],
            'ship_message' => $request->message,
        ]);

        return $this->messageResponse(true, '訂單更新成功');
    }



    private function checkRequest(Request $request)
    {
        $order = $request->input('user');
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
        return $order;
    }

    private function messageResponse($boolean, $message, $status = 200)
    {
        return response()->json(['success' => $boolean, 'message' => $message], $status);
    }

}
