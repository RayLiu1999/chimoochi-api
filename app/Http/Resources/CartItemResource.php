<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CouponResource;
use App\Models\Product;
use App\Models\Coupon;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->coupon) {
            $discountPresent = $this->coupon->discount_present;
        }
        $products = new ProductResource(Product::find($this->product_id));

        return [
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'is_discounted' => isset($discountPresent) ? true : false,
            'discount_present' => $discountPresent ?? 100,
            'discount_price' => isset($discountPresent) ? ($discountPresent / 100 * $products->price) : $products->price,
            'product' => $products,
        ];
    }
}