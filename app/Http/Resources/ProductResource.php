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
            'title' => $this->title,
            'category' => (new CategoryResource($this->category))->name,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'origin_price' => $this->origin_price,
            'price' => $this->price,
            'unit' => $this->unit,
            'is_enabled' => $this->is_enabled,
            'quantity' => $this->quantity
        ];
    }
}
