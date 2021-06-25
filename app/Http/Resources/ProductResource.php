<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => (new CategoryResource($this->category))->name,
            'image_url' => $this->image_url,
            'desc' => $this->desc,
            'origin_price' => $this->origin_price,
            'price' => $this->price,
            'unit' => $this->unit,
            'enabled' => $this->enabled,
            'quantity' => $this->quantity
        ];
    }
}
