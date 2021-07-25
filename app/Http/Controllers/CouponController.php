<?php

namespace App\Http\Controllers;

use App\Http\Resources\CouponResource;
use App\Models\Coupon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        return response()->json(['success' => true, 'data' => CouponResource::collection(Coupon::paginate($limit))]);
    }

    public function store(Request $request)
    {
        if (($reqCoupon = $this->checkRequest($request)) === false) {
            return $this->messageResponse(false, '格式錯誤', 400);
        }

        Coupon::create([
            'name' => $reqCoupon['name'],
            'code' => $reqCoupon['code'],
            'discount_present' => $reqCoupon['discount_present'],
            'is_enabled' => $reqCoupon['is_enabled'],
            'expired_at' => date("Y-m-d H:i:s", $reqCoupon['expired_at']),
        ]);

        return $this->messageResponse(true, '新增優惠券成功');
    }

    public function update(Request $request, Coupon $coupon)
    {
        if (($reqCoupon = $this->checkRequest($request)) === false) {
            return $this->messageResponse(false, '格式錯誤', 400);
        }

        $coupon->update([
            'name' => $reqCoupon['name'],
            'code' => $reqCoupon['code'],
            'discount_present' => $reqCoupon['discount_present'],
            'is_enabled' => $reqCoupon['is_enabled'],
            'expired_at' => date("Y-m-d H:i:s", $reqCoupon['expired_at']),
        ]);

        return $this->messageResponse(true, '優惠券更新成功');

    }

    public function destroy(Coupon $coupon)
    {
        if ($coupon->delete()) {
            return $this->messageResponse(true, '優惠券刪除成功');
        }
        return $this->messageResponse(false, '刪除失敗', 403);
    }



    private function checkRequest(Request $request)
    {
        $coupon = $request->input('coupon');
        $validator = Validator::make($coupon, [
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
            'discount_present' => ['required', 'integer'],
            'is_enabled' => ['required', 'boolean'],
            'expired_at' => ['required', 'integer'],
        ]);
        if ($validator->fails()) {
            return false;
        }
        return $coupon;
    }

    private function messageResponse($boolean, $message, $status = 200)
    {
        return response()->json(['success' => $boolean, 'message' => $message], $status);
    }

}
