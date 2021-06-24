<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $validator;

    public function __construct()
    {
        $this->middleware('auth.jwt', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        return response()->json([
            'success' => true, 'data' => [
            'products' => ProductResource::collection(Product::all()),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $this->check($request);
        
        if ($this->validator->fails()) {
            return response()->json(['success' => false, 'message' => '格式錯誤'], 422);
        };

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $request->file('image')->storeAs(
                'uploads/images',
                $file->getClientOriginalName(),
                'public'
            );
            // var_dump(asset(Storage::disk('public')->url($path)));
            // $path = public_path() . '/uploads/images/';
            // $file->move($path, );
            // dd(compact('path'));
        };

        $category_name = $request->input('category');
        $category = Category::where('name', $category_name)->first();

        Product::create([
            'name' => $request->input('name'),
            'category_id' => $category->id,
            'image_url' => $request->input('image_url') ?? asset('storage/' . $path),
            'desc' => $request->input('desc'),
            'origin_price' => $request->input('origin_price'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'enabled' => $request->boolean('enabled'),
            'quantity' => $request->input('quantity'),
        ]);

        return response()->json(['success' => true, 'message' => '商品建立成功']);
    }

    public function show(Product $product)
    {
        return response()->json([
            'success' => true, 'data' => [
            'product' => new ProductResource($product),
            ],
        ]);
    }

    public function update(Product $product, Request $request)
    {
        $this->check($request);
        
        if ($this->validator->fails()) {
            return response()->json(['success' => false, 'message' => '格式錯誤'], 422);
        };

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
            'desc' => $request->input('desc'),
            'origin_price' => $request->input('origin_price'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'enabled' => $request->boolean('enabled'),
            'quantity' => $request->input('quantity'),
        ]);

        return response()->json(['success' => true, 'message' => '商品更新成功']);
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return response()->json(['success' => true, 'message' => '商品刪除成功']);
        }

        return response()->json(['success' => false, 'message' => '錯誤'], 403);
    }

    public function check($request)
    {
        $this->validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'category' => ['required', 'string'],
            'image_url' => ['string', 'max:255', 'min:10'],
            'image' => ['file', 'image'],
            'desc' => ['required', 'string', 'max:450'],
            'origin_price' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'enabled' => ['boolean'],
            'quantity' => ['required', 'integer'],
        ]);

    }
}
