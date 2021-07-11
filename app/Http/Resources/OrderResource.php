<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'order_number' => $this->order_number,
            'ship_name' => $this->ship_name,
            'ship_phone' => $this->ship_phone,
            'ship_email' => $this->ship_email,
            'ship_address' => $this->ship_message,
            'order_status' => $this->order_status ?? 1,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'order_items' => OrderItemResource::collection($this->orderItems),
        ];
    }
}
