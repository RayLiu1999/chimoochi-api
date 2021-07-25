<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{    
    public function index(Request $request)
    {
        $limit = $request->limit ?? 12;

        return response()->json([
            'success' => true, 
            'data' => [
                'products' => ProductResource::collection(Product::paginate($limit)),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $path = null;

        if ($this->validateRequest($request) === false) {
            return $this->messageResponse(false, '格式錯誤', 400);        
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $request->file('image')->storeAs(
                'uploads/images',
                $file->getClientOriginalName(),
                'public'
            );
        };

        $category_name = $request->input('category');
        $category = Category::where('name', $category_name)->first();
        
        Product::create([
            'name' => $request->input('name'),
            'category_id' => $category->id,
            'image_url' => $request->input('image_url') ?? asset('storage/' . $path),
            'description' => $request->input('description') ?? '',
            'origin_price' => $request->input('origin_price'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'is_enabled' => $request->boolean('is_enabled'),
            'quantity' => $request->input('quantity'),
            'message' => $request->input('message'),
        ]);
        return $this->messageResponse(true, '商品建立成功');
    }

    public function show($id)
    {
        return response()->json([
            'success' => true, 
            'data' => [
                'product' => new ProductResource(Product::findOrFail($id)),
            ],
        ]);
    }

    public function update(Product $product, Request $request)
    {
        if ($this->validateRequest($request) === false) {
            return $this->messageResponse(false, '格式錯誤', 400);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $request->file('image')->storeAs(
                'uploads/images',
                $file->getClientOriginalName(),
                'public'
            );
        };

        $category_name = $request->input('category');
        $category = Category::where('name', $category_name)->first();

        $product->update([
            'name' => $request->input('name'),
            'category_id' => $category->id,
            'image_url' => $request->input('image_url') ?? asset('storage/' . $path),
            'description' => $request->input('desc'),
            'origin_price' => $request->input('origin_price'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'is_enabled' => $request->boolean('is_enabled'),
            'quantity' => $request->input('quantity'),
            'message' => $request->input('message'),
        ]);

        return $this->messageResponse(true, '商品更新成功');    
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return $this->messageResponse(true, '商品刪除成功');
        }
        return $this->messageResponse(false, '刪除失敗', 403);
    }



    private function messageResponse($boolean, $message, $status = 200)
    {
        return response()->json(['success' => $boolean, 'message' => $message], $status);
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'category' => ['required', 'string'],
            'image_url' => ['string', 'max:255', 'min:10'],
            'image' => ['file', 'image'],
            'description' => ['required', 'string', 'max:450'],
            'origin_price' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'is_enabled' => ['boolean'],
            'quantity' => ['required', 'integer'],
            'message' => ['nullable', 'string', 'max: 100'],
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}
