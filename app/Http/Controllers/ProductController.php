<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() // 商品呈現記得不用權限
    {
        return response()->json([
            'message' => 'success',
            'products' => ProductResource::collection(Product::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'category' => ['required', 'string'],
            'image_url' => ['string', 'max:255', 'min:10'],
            'image' => ['file', 'image'],
            'desc' => ['required', 'string', 'max:450'],
            'origin_price' => ['required', 'integer'],
            'price' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'is_enabled' => ['required', 'boolean'],
            'quantity' => ['required', 'integer'],
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => '格式錯誤'], 422);
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
            'is_enabled' => $request->boolean('is_enabled'),
            'quantity' => $request->input('quantity'),
        ]);

        return response()->json(['message' => '商品建立成功']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)  // 要過濾products傳過來的資料(注意category_id)
    {
        return response()->json([
            'message' => 'success',
            'products' => new ProductResource(Product::find($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = $request->all();
        Product::where();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
