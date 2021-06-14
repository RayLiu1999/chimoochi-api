<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image_url',
        'desc',
        'origin_price',
        'price',
        'unit',
        'is_enabled',
        'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
