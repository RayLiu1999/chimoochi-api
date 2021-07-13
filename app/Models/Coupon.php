<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'discount_present', 'is_enabled'];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
